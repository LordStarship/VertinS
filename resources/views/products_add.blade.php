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
                <div class="w-24 h-24 overflow-hidden">
                    <img class="object-cover rounded-full w-full h-full" src="{{ asset('images/admin-logo.jpg') }}">
                </div>
                <p class="mt-4 text-secondary text-xl font-medium">{{ session('username') }}</p>
                <p class="mt-4 text-secondary text-lg font-normal">Admin</p>
            </div>
            <div class="h-3/6 flex flex-col items-center justify-center">
                <a class="ml-4 py-1 w-4/5 border border-secondary rounded-md flex flex-row items-center justify-center cursor-pointer">
                    <img class="w-4" src="img/category-active.png">
                    <p class="ml-6 text-secondary text-md font-light">Category</p>
                </a>
                <a href={{ route('products')}} class="ml-4 mt-2 py-1 w-4/5 border bg-secondary rounded-md border-secondary flex flex-row items-center justify-center cursor-pointer">
                    <img class="w-4" src="img/products-inactive.png">
                    <p class="ml-6 text-primary text-md font-medium">Products</p>
                </a>
                <a class="ml-4 mt-2 py-1 w-4/5 border border-secondary rounded-md flex flex-row items-center justify-center cursor-pointer">
                    <img class="w-4" src="img/account-info-active.png">
                    <p class="ml-6 text-secondary text-md font-light">Account Info</p>
                </a>
            </div>
            <div class="h-1/6 flex flex-row items-center justify-center">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex flex-row cursor-pointer">
                        <p class="mr-2 text-secondary text-md font-bold">Logout</p>
                        <img class="w-6" src="img/logout-icon.png">
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
                        <label class="block text-sm font-medium text-gray-700">Product Name</label>
                        <input type="text" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required />
                    </div>
            
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="4" class="mt-1 block h-8 w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                    </div>
            
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Categories</label>
                        <select name="categories[]" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Price</label>
                        <input type="number" step="10000" name="price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required />
                    </div>
            
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Images</label>
                        <input type="file" name="images[]" multiple class="mt-1 block w-full" />
                        <small class="text-gray-500">You can upload up to 5 images. One image must be set as default.</small>
                    </div>
            
                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="isDefault" class="form-checkbox" required />
                            <span class="ml-2">Set this as the default image</span>
                        </label>
                    </div>
            
                    <button type="submit" class="bg-primary text-secondary px-4 py-2 rounded-md">Add Product</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
