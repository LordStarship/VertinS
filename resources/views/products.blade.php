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
            <div class="h-1/6 flex flex-col items-center justify-center">
                <p class="mt-4 text-secondary text-xl font-medium">{{ session('username') }}</p>
                <p class="mt-4 text-secondary text-lg font-normal">Admin</p>
            </div>
            <div class="h-3/6 flex flex-col items-center justify-center">
                <a href={{ route('categories')}} class="ml-4 py-1 w-4/5 border border-secondary rounded-md flex flex-row items-center justify-center cursor-pointer">
                    <img class="w-4" src="img/category-active.png">
                    <p class="ml-6 text-secondary text-md font-light">Category</p>
                </a>
                <a href={{ route('products')}} class="ml-4 mt-2 py-1 w-4/5 border bg-secondary rounded-md border-secondary flex flex-row items-center justify-center cursor-pointer">
                    <img class="w-4" src="img/products-inactive.png">
                    <p class="ml-6 text-primary text-md font-medium">Products</p>
                </a>
                <a href={{ route('accounts')}} class="ml-4 mt-2 py-1 w-4/5 border border-secondary rounded-md flex flex-row items-center justify-center cursor-pointer">
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
        <div class="p-8 w-10/12 flex flex-col">
            <div class="h-2/6 flex flex-col">
                <div class="pb-4 flex flex-row w-full border-b-2 border-gray-300">
                    <p class="text-primary text-3xl font-bold">Product List</p>
                    <div class="flex flex-row ml-auto">
                        <input type="text" id="search-input" placeholder="Search..." class="mr-4 pl-4 border border-secondary rounded-md" autocomplete="off">
                        <a href={{ route('products.create')}} class="px-2 bg-primary rounded-md flex items-center justify-center cursor-pointer">
                            <p class="  text-secondary text-md font-bold">ADD NEW PRODUCT</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="h-4/6 overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="w-1/12"></th>
                            <th class="w-1/12 text-gray-600">Name</th>
                            <th class="w-3/12 text-gray-600">Description</th>
                            <th class="w-2/12 text-gray-600">Tags</th>
                            <th class="w-2/12 text-gray-600">Price</th>
                            <th class="w-2/12 text-gray-600">Image</th>
                            <th class="w-1/12"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr class="mt-8">
                            <td class="flex justify-center">
                                <div class="w-16 h-16 overflow-hidden">
                                    <img class="object-cover rounded-full w-full h-full" src="img/admin-logo.jpg">
                                </div>
                            </td>
                            <td>
                                <p>{{ $products->name }}</p>
                            </td>
                            <td>
                                <p>{{ $products->description }}</p>
                            </td>
                            <td class="flex items-center justify-center">
                                <div class="background-gray-600">
                                    <p>{{ $product->categories_count }} Tags Embed </p>
                                </div>
                            </td>
                            <td>
                                <p>Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            </td>
                            <td>
                                <div class="background-gray-600">
                                    <p>{{ $product->pictures_count }} Pictures Embed </p>
                                </div>
                            </td>
                            <td>
                                <div class="flex items-center justify-center">
                                    <a class="flex items-center p-2 bg-gray-100 hover:bg-gray-200 rounded-md">
                                        <img src="img/edit-logo.png" alt="Edit" class="w-5 h-5">
                                    </a>
                                    <form  method="POST" class="flex items-center p-2 bg-gray-100 hover:bg-gray-200 rounded-md">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <img src="img/delete-logo.png" alt="Delete" class="w-5 h-5">
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
