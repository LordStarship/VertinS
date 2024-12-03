<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Add New Products</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<body>
    <div class="h-screen flex flex-row overflow-hidden">
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
                   class="py-2 w-4/5 flex items-center border border-secondary rounded-md cursor-pointer hover:bg-secondary-light">
                    <img class="w-5 ml-4" src="{{ asset('storage/img/category-active.png') }}" alt="Category Icon">
                    <p class="ml-4 text-secondary text-base font-light">Category</p>
                </a>
                <a href="{{ route('products.index') }}" 
                   class="py-2 w-4/5 flex items-center border border-secondary bg-secondary rounded-md cursor-pointer hover:bg-secondary-light">
                    <img class="w-5 ml-4" src="{{ asset('storage/img/products-inactive.png') }}" alt="Products Icon">
                    <p class="ml-4 text-primary text-base font-medium">Products</p>
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
        <div class="p-4 w-10/12 flex flex-col">
            <div class="container mx-auto p-6">
                <h1 class="text-2xl font-bold mb-4">Add New Product</h1>
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Product Name</label>
                        <input type="text" id="title" name="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" maxlength="100" required/>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="categories" class="block text-sm font-medium text-gray-700">Categories</label>
                        <select id="categories" name="categories[]" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-gray-500">Hold down Ctrl (Windows) or Command (Mac) to select multiple options.</small>
                    </div>
                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                        <input type="number" id="price" name="price" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="images" class="block text-sm font-medium text-gray-700">Images</label>
                        <input type="file" id="images" name="images[]" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" accept="image/*" required>
                        <small class="text-gray-500">You can upload up to 5 images. The first image will be set as the default thumbnail.</small>
                    </div>
                    <button type="submit" class="bg-primary text-secondary px-4 py-2 rounded-md hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary-dark focus:ring-offset-2">
                        Add Product
                    </button>
                </form>
            </div>
        </div>        
    </div>
</body>
</html>
