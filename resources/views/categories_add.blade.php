<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <div class="h-3/6 flex flex-col items-center justify-center">
                <a href={{ route('categories')}} class="ml-4 mt-2 py-1 w-4/5 border bg-secondary rounded-md border-secondary flex flex-row items-center justify-center cursor-pointer">
                    <img class="w-4" src={{ asset('storage/img/category-inactive.png') }}>
                    <p class="ml-6 text-primary text-md font-medium">Category</p>
                </a>
                <a href={{ route('products')}} class="ml-4 mt-2 py-1 w-4/5 border border-secondary rounded-md flex flex-row items-center justify-center cursor-pointer">
                    <img class="w-4" src={{ asset('storage/img/products-active.png') }}>
                    <p class="ml-6 text-secondary text-md font-light">Products</p>
                </a>
                <a class="ml-4 mt-2 py-1 w-4/5 border border-secondary rounded-md flex flex-row items-center justify-center cursor-pointer">
                    <img class="w-4" src={{ asset('storage/img/account-info-active.png') }}>
                    <p class="ml-6 text-secondary text-md font-light">Account Info</p>
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
        <div class="p-8 w-10/12 flex flex-col">
            <div class="h-2/6 flex flex-col">
                <div class="pb-4 flex flex-row w-full border-b-2 border-gray-300">
                    <p class="text-primary text-3xl font-bold">Categories List</p>
                    <div class="flex flex-row ml-auto">
                        <input type="text" id="search-input" placeholder="Search..." class="mr-4 pl-4 border border-secondary rounded-md" autocomplete="off">
                        <a href={{ route('categories.create')}} class="px-2 bg-primary rounded-md flex items-center justify-center cursor-pointer">
                            <p class="  text-secondary text-md font-bold">ADD NEW CATEGORY</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="h-4/6 overflow-x-auto">
                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Categories Name</label>
                        <input type="text" name="name" class="mt-1 pl-2 block w-full border-gray-300 rounded-md shadow-sm" required />
                    </div>
                    <button type="submit" class="bg-primary text-secondary px-4 py-2 rounded-md">Add Category</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
