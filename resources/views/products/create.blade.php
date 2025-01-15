<!DOCTYPE html>
<html lang="en">
<head>
    @vite('resources/css/app.css')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add New Products</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<body>
    <div class="h-screen flex flex-row overflow-hidden">
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
                    {{ session('role') == 0 ? 'Superadmin' : 'Admin' }}
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
                @if (session('role') == 0)
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
        <div class="p-4 w-full flex flex-col overflow-x-auto">
            <div class="container mx-auto p-6">
                <div class="h-1/6 flex flex-col">
                    <div class="pb-4 flex flex-row w-full border-b-2 border-gray-300">
                        <p class="text-primary text-3xl font-bold">Add Product</p>
                    </div>
                </div>
                <div class="h-5/6">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-2 gap-6">
                        @csrf
                        <div class="col-span-1">
                            <label for="title" class="block text-sm font-medium text-gray-700">Product Name</label>
                            <input type="text" id="title" name="title" class="mt-1 pl-2 block w-full border border-gray-300 rounded-md shadow-sm" maxlength="100" required/>
                        </div>
                        <div class="col-span-1">
                            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" id="price" name="price" step="0.01" class="mt-1 pl-2 block w-full border border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="description" name="description" rows="4" class="mt-1 pl-2 block w-full border border-gray-300 rounded-md shadow-sm" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="search-input" class="block text-sm font-medium text-gray-700">Search Categories</label>
                            <input type="text" id="search-input" class="mt-1 pl-2 block w-full border border-gray-300 rounded-md shadow-sm" placeholder="Type to search...">
                        </div>
                        <div id="categories-container" class="h-40 overflow-y-scroll border border-gray-300 rounded-md p-2">
                            @foreach($categories as $category)
                                <div class="flex items-center mb-2">
                                    <input type="checkbox" id="category-{{ $category->id }}" name="categories[]" value="{{ $category->id }}" class="mr-2">
                                    <label for="category-{{ $category->id }}" class="text-sm font-medium text-gray-700">{{ $category->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-span-2">
                            <label for="images" class="block text-sm font-medium text-gray-700">Images</label>
                            <input type="file" id="images" name="images[]" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" accept="image/*" required>
                            <small class="text-gray-500">You can upload up to 4 images. The first image will be set as the default thumbnail.</small>
                        </div>
                        <div class="col-span-2 pb-8 flex justify-end">
                            <button type="submit" class="bg-primary text-secondary px-4 py-2 rounded-md hover:bg-primary-passive">
                                Add Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>     
    </div>
</body>
</html>
<script>
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

