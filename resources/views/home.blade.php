<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>VertinS | Admin</title>
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
                <div class="w-24 h-24 overflow-hidden">
                    <img class="object-cover rounded-full w-full h-full" src="img/admin-logo.jpg">
                </div>
                <p class="mt-4 text-secondary text-xl font-medium">{{ session('username') }}</p>
                <p class="mt-4 text-secondary text-lg font-normal">Admin</p>
            </div>
            <div class="h-3/6 flex flex-col items-center justify-center">
                <a class="ml-4 py-1 w-4/5 border border-secondary rounded-md flex flex-row items-center justify-center cursor-pointer">
                    <img class="w-4" src="img/category-active.png">
                    <p class="ml-6 text-secondary text-md font-light">Category</p>
                </a>
                <a class="ml-4 mt-2 py-1 w-4/5 border bg-secondary rounded-md border-secondary flex flex-row items-center justify-center cursor-pointer">
                    <img class="w-4" src="img/products-inactive.png">
                    <p class="ml-6 text-primary text-md font-medium">Products</p>
                </a>
                <a class="ml-4 mt-2 py-1 w-4/5 border border-secondary rounded-md flex flex-row items-center justify-center cursor-pointer">
                    <img class="w-4" src="img/account-info-active.png">
                    <p class="ml-6 text-secondary text-md font-light">Account Info</p>
                </a>
            </div>
            <div class="h-1/6 flex flex-row items-center justify-center">
                <a class="flex flex-row cursor-pointer">
                    <p class="mr-2 text-secondary text-md font-bold">Logout</p>
                    <img class="w-6" src="img/logout-icon.png">
                </a>
            </div>
        </div>
        <div class="p-4 w-10/12 flex flex-col">
            <div class="h-1/6 flex flex-col">
                kvarc
            </div>
            <div class="h-5/6">
                kvarc
            </div>
        </div> 
    </div>
    kvarc 
    kvarc
    kvarc
</body>
</html>
