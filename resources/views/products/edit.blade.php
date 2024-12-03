<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <title>VertinS | Products</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<body>
    <div class="h-screen flex flex-row">
        <div class="w-2/12 flex flex-col bg-primary">
            <div class="h-1/6 flex flex-row items-center justify-center">
                <p class="text-secondary text-2xl font-bold">ADMIN LIST</p>
            </div>
            <div class="h-2/6 flex flex-col items-center justify-center">
                <p class="mt-4 text-secondary text-xl font-medium">{{ session('username') }}</p>
                <p class="mt-4 text-secondary text-lg font-normal">Admin</p>
            </div>
            <div class="h-3/6 flex flex-col items-center justify-center space-y-3">
                <a href="{{ route('categories.index') }}" 
                   class="py-2 w-4/5 flex items-center border border-secondary bg-secondary rounded-md cursor-pointer hover:bg-secondary-light">
                    <img class="w-5 ml-4" src="{{ asset('storage/img/category-inactive.png') }}" alt="Category Icon">
                    <p class="ml-4 text-primary text-base font-medium">Category</p>
                </a>
                
                <a href="{{ route('products.index') }}" 
                   class="py-2 w-4/5 flex items-center border border-secondary rounded-md cursor-pointer hover:bg-secondary-light">
                    <img class="w-5 ml-4" src="{{ asset('storage/img/products-active.png') }}" alt="Products Icon">
                    <p class="ml-4 text-secondary text-base font-light">Products</p>
                </a>
                
                <a href="{{ route('accounts') }}" 
                   class="py-2 w-4/5 flex items-center border border-secondary rounded-md cursor-pointer hover:bg-secondary-light">
                    <img class="w-5 ml-4" src="{{ asset('storage/img/account-info-active.png') }}" alt="Account Info Icon">
                    <p class="ml-4 text-secondary text-base font-light">Account Info</p>
                </a>
            </div>            
            <div class="h-1/6 flex flex-row items-center justify-center">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex flex-row cursor-pointer">
                        <p class="mr-2 text-secondary text-md font-bold">Logout</p>
                        <img class="w-6" src={{ asset('storage/img/logout-icon.png') }}>
                    </button>
                </form>
            </div>
        </div>
        <div class="p-8 w-10/12 overflow-y-scroll flex flex-col">
            <div class="h-1/6 flex flex-col">
                <div class="pb-4 flex flex-row w-full   ">
                    <p class="text-primary text-3xl font-bold">Edit Product</p>
                </div>
            </div>
            <div class="h-5/6 overflow-x-auto">
                <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
            
                    <!-- Product Title -->
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium">Title</label>
                        <input type="text" id="title" name="title" value="{{ $product->title }}" required
                            class="w-full p-2 border border-gray-300 rounded">
                    </div>
            
                    <!-- Product Description -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium">Description</label>
                        <textarea id="description" name="description" required
                            class="w-full p-2 border border-gray-300 rounded">{{ $product->description }}</textarea>
                    </div>
            
                    <!-- Product Price -->
                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium">Price (Rupiah)</label>
                        <input type="number" id="price" name="price" value="{{ $product->price }}" step="0.01" required
                            class="w-full p-2 border border-gray-300 rounded">
                    </div>
            
                    <!-- Categories -->
                    <div class="mb-4">
                        <label for="categories" class="block text-sm font-medium">Categories</label>
                        <select id="categories" name="categories[]" multiple required class="w-full p-2 border border-gray-300 rounded">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $product->categories->contains($category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
            
                    <!-- Pictures -->
                    <!-- Pictures -->
                    <div class="mb-4">
                        <label for="images" class="block font-semibold">Pictures</label>
                        <div class="flex gap-2">
                            @foreach ($product->pictures as $index => $picture)
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $picture->path) }}" alt="Picture {{ $index + 1 }}" class="h-20 w-20 object-cover">
                                    @if ($product->pictures->count() > 1)
                                        <button type="button" class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-2"
                                            onclick="deletePicture({{ $picture->id }})">X</button>
                                    @endif
                                </div>
                            @endforeach
                            <label class="flex items-center justify-center border h-20 w-20 cursor-pointer">
                                <i class="fa-solid fa-plus"></i>
                                <input type="file" name="images[]" multiple hidden onchange="this.form.submit()"> <!-- Auto-submit when images are added -->
                            </label>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">First picture is the default thumbnail.</p>
                    </div>

                    <!-- Save and Cancel Buttons -->
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('products.index') }}" class="py-2 px-4 rounded border-secondary bg-gray-200 text-secondary font-bold">
                            Cancel
                        </a>
                        <button type="submit" class="py-2 px-4 rounded border-secondary bg-primary text-secondary font-bold">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    function deletePicture(pictureId) {
        if (confirm('Are you sure you want to delete this picture?')) {
            fetch(`/pictures/${pictureId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                }
                throw new Error('Failed to delete picture.');
            })
            .then(data => {
                alert(data.message); // Optional: Show success message
                location.reload(); // Reload page to reflect changes
            })
            .catch(error => {
                alert(error.message); // Display error message
            });
        }
    }
</script>