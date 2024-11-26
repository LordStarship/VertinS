<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>VertinS | Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="h-screen overflow-hidden">
        <div id="login" class="h-full">
            <div class="flex flex-col w-full h-full">
                <div class="h-1/6 flex items-center justify-center">
                    <img class="h-32" src={{ asset('storage/img/logo.png') }}>
                    <p class="text-5xl font-bold">VertinS</p>
                </div>
                <div class="flex flex-row justify-evenly w-full h-full items-center">
                    <div class="w-2/5 h-full">
                        <div class="flex flex-col h-full justify-center">
                            <div id="login-top">
                                <div class="flex flex-col items-center justify-center mb-8">
                                    <h2 class="text-3xl font-bold">Welcome 👋</h2>
                                    <p class="text-lg font-normal">Login untuk memasuki dashboard admin.</p>
                                    @if(session('success'))
                                        <div class="bg-green-500 text-white p-2 rounded mb-3">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex flex-row">
                                    <a href="{{ route('login') }}" class="w-1/2">
                                        <button class="w-full py-2 text-center font-bold text-gray-900 border-b-2 border-primary">
                                            Login
                                        </button>
                                    </a>
                                    <a href="{{ route('signup.page') }}" class="w-1/2">
                                        <button class="w-full py-2 text-center font-bold text-gray-500 hover:text-gray-900 transition duration-200">
                                            Sign Up
                                        </button>
                                    </a>  
                                </div>                    
                            </div>
                            <div>
                                <form id="login-form" class="w-full" action="{{ route('login.form') }}" method="post"> 
                                    @csrf
                                    <div class="py-3">
                                        <label class="font-medium" for="nameandemail">Name or Email</label>
                                        <br />
                                        <input class="mt-2 border border-gray-500 rounded-full py-2 pl-4 w-full" type="text" name="nameandemail" id="nameandemail" placeholder="Enter name or email">
                                    </div>
                                    <div class="py-3">
                                        <label class="font-medium" for="password">Password</label>
                                        <br />
                                        <input class="mt-2 border border-gray-500 rounded-full py-2 pl-4 w-full" type="password" name="password" id="password" placeholder="Enter password">
                                    </div>
                                    <button class="py-2 w-full border rounded-full bg-primary text-secondary font-bold hover:bg-primary-passive transition duration-200" type="submit" class="btn">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="login-right" class="w-2/5 h-full">
                        <div class="flex items-center h-full">
                            <img class="rounded-2xl h-38" src={{ asset('storage/img/login-pic.jpg') }}>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</body>
</html>