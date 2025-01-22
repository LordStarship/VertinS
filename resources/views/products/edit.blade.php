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
    <link rel="icon" type="image/x-icon" href= {{ asset('storage/img/logo.png') }}>
<body>
    <div class="h-screen flex flex-row">
        <div class="w-2/12 flex flex-col bg-primary">
            <div class="h-1/6 flex flex-row items-center justify-center">
                <a href={{route('home')}}>
                    <div class="flex-shrink-0">
                        <img class="h-32 w-32" src={{ asset('storage/img/logo-user-2.png') }} alt="VertinS Logo">
                    </div>
                </a>
            </div>
            <div class="h-2/6 flex flex-col items-center justify-center">
                <p class="mt-4 text-secondary text-xl font-medium">Welcome, {{ session('username') }}!</p>
                <p class="mt-4 text-secondary text-lg font-normal italic">
                    {{ session('role') == '0' ? 'Superadmin' : 'Admin' }}
                </p>
            </div>
            <div class="h-3/6 flex flex-col items-center justify-center space-y-3">
                <a href="{{ route('categories.index') }}" 
                   class="py-2 w-4/5 flex items-center border border-secondary rounded-md cursor-pointer hover:bg-gray-500">
                    <img class="w-5 ml-4" src="{{ asset('storage/img/category-active.png') }}" alt="Category Icon">
                    <p class="ml-4 text-secondary text-base font-light">Category</p>
                </a>                
                <a href="{{ route('products.index') }}" 
                   class="py-2 w-4/5 flex items-center border border-secondary bg-secondary rounded-md cursor-pointer">
                    <img class="w-5 ml-4" src="{{ asset('storage/img/products-inactive.png') }}" alt="Products Icon">
                    <p class="ml-4 text-primary text-base font-medium">Products</p>
                </a>
                @if (session('role') == '0')
                    <a href="{{ route('admins.index') }}" 
                       class="py-2 w-4/5 flex items-center border border-secondary rounded-md cursor-pointer hover:bg-gray-500">
                        <img class="w-5 ml-4" src="{{ asset('storage/img/admin-active.png') }}" alt="Admin List Icon">
                        <p class="ml-4 text-secondary text-base font-light">Admin List</p>
                    </a>
                @endif
                <a href="{{ route('accounts.index') }}" 
                   class="py-2 w-4/5 flex items-center border border-secondary rounded-md cursor-pointer hover:bg-gray-500">
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

        @if (session('error'))
            <script>
                alert('{{ session('error') }}');
            </script>
        @endif
        
        @if (session('success'))
            <script>
                alert('{{ session('success') }}');
            </script>
        @endif

        <div class="p-8 w-10/12 flex flex-col">
            <div class="h-1/6 flex flex-col">
                <div class="pb-4 flex flex-row w-full   ">
                    <p class="text-primary text-3xl font-bold">Edit Product</p>
                </div>
            </div>
            <div class="h-5/6 overflow-x-auto">
                <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data" class="grid grid-cols-2 gap-6">
                    @csrf
                    @method('PUT')
                    <div class="col-span-1">
                        <label for="title" class="block text-sm font-medium text-gray-700">Product Name</label>
                        <input type="text" id="title" name="title" value="{{ $product->title }}" class="mt-1 pl-2 block w-full border border-gray-300 rounded-md shadow-sm" maxlength="100" required/>
                    </div>
                    <div class="col-span-1">
                        <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                        <input type="number" id="price" name="price" value="{{ $product->price }}" step="0.01" class="mt-1 pl-2 block w-full border border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea id="description" name="description" rows="4" class="mt-1 pl-2 block w-full border border-gray-300 rounded-md shadow-sm" required>{{ $product->description }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="search-input" class="block text-sm font-medium text-gray-700">Search Categories</label>
                        <input type="text" id="search-input" class="mt-1 pl-2 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Type to search...">
                    </div>
                    <div id="categories-container" class="h-40 overflow-y-scroll border border-gray-300 rounded-md p-2">
                        @foreach($categories as $category)
                            <div class="flex items-center mb-2">
                                <input type="checkbox" id="category-{{ $category->id }}" name="categories[]" value="{{ $category->id }}" class="mr-2" 
                                {{ $product->categories->contains($category->id) ? 'checked' : '' }}>
                                <label for="category-{{ $category->id }}" class="text-sm font-medium text-gray-700">{{ $category->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-span-2 mb-4">
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
                    <div class="col-span-2 flex justify-end gap-4 pr-4">
                        <a href="{{ route('products.index') }}" class="py-2 px-4 rounded border-secondary bg-primary text-secondary font-bold hover:bg-primary-passive">
                            Cancel
                        </a>
                        <button type="submit" class="col-span-2 py-2 px-4 rounded border-secondary bg-primary text-secondary font-bold hover:bg-primary-passive">
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
                alert(data.message); 
                location.reload(); 
            })
            .catch(error => {
                alert(error.message); 
            });
        }
    }

    document.querySelector('#search-input').addEventListener('input', (event) => {
    const searchValue = event.target.value.trim();
    
    if (!searchValue) {
        renderCategoryList([]); 
        return;
    }

    fetch('/products/search-categories', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 
        },
        body: JSON.stringify({ query: searchValue }),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then((data) => {
            renderCategoryList(data); 
        })
        .catch((error) => {
            console.error('Error fetching categories:', error);
        });
    });

    function renderCategoryList(categories) {
        const categoryContainer = document.querySelector('#categories-container');
        categoryContainer.innerHTML = ''; 

        if (categories.length === 0) {
            categoryContainer.innerHTML = '<p class="text-gray-500">No categories found.</p>';
            return;
        }

        categories.forEach((category) => {
            const label = document.createElement('label');
            label.className = 'block';

            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.name = 'categories[]';
            checkbox.value = category.id;

            label.appendChild(checkbox);
            label.appendChild(document.createTextNode(` ${category.name}`));

            categoryContainer.appendChild(label);
        });
    }
</script>