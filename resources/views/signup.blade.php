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
        <div id="signup" class="h-full">
            <div class="flex flex-col w-full h-full">
                <div class="h-1/6 flex items-center justify-center">
                    <img class="h-32" src="img/logo.png">
                    <p class="text-5xl font-bold">VertinS</p>
                </div>
                <div class="flex flex-row justify-evenly w-full h-full items-center">
                    <div class="w-2/5 h-full">
                        <div class="flex flex-col h-full justify-center">
                            <div id="signup-top">
                                <div class="flex flex-col items-center justify-center mb-8">
                                    <h2 class="text-3xl font-bold">Welcome 👋</h2>
                                    <p class="text-lg font-normal">Login untuk memasuki dashboard admin.</p>
                                    @error('username')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                    @error('signup-password')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                    @error('signup-cpassword')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror                                  
                                </div>
                                <div class="flex flex-row">
                                    <a href="{{ route('login') }}" class="w-1/2">
                                        <button class="w-full py-2 text-center font-bold text-gray-500 hover:text-gray-900 transition duration-200">
                                            Login
                                        </button>
                                    </a>
                                    <a href="{{ route('signup.page') }}" class="w-1/2">
                                        <button class="w-full py-2 text-center font-bold text-gray-900 border-b-2 border-primary">
                                            Sign Up
                                        </button>
                                    </a>  
                                </div>                              
                            </div>
                            <div>
                                <form id="signup-form" class="w-full" action="{{ route('signup') }}" method="post"> 
                                    @csrf
                                    <div>
                                        <label class="font-medium" for="username">Username</label>
                                        <br />
                                        <input class="border border-gray-500 rounded-full py-2 pl-4 w-full" type="text" name="username" id="username" placeholder="Enter name">
                                    </div>
                                    <div>
                                        <label class="font-medium" for="email">Email</label>
                                        <br />
                                        <input class="border border-gray-500 rounded-full py-2 pl-4 w-full" type="email" name="email" id="email" placeholder="Enter email">
                                    </div>
                                    <div>
                                        <label class="font-medium" for="signup-password">Password</label>
                                        <br />
                                        <input class="border border-gray-500 rounded-full py-2 pl-4 w-full" type="password" name="signup-password" id="signup-password" placeholder="Enter password" oninput="toggleConfirmPassword()">
                                    </div>
                                    <div>
                                        <label class="font-medium" for="signup-cpassword">Confirm Password</label>
                                        <br />
                                        <input class="border border-gray-500 rounded-full py-2 pl-4 w-full" type="password" name="signup-cpassword" id="signup-cpassword" placeholder="Confirm password" disabled oninput="enableSubmitButton()">
                                    </div>
                                    <button id="signup-button" class="mt-2 py-2 w-full border rounded-full bg-primary text-secondary font-bold hover:bg-primary-passive transition duration-200 cursor-not-allowed" type="submit" disabled>Sign Up</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="signup-right" class="w-2/5 h-full">
                        <div class="flex items-center h-full">
                            <img class="rounded-2xl h-38" src="img/login-pic.jpg">
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</body>
</html>
<script>
    function toggleConfirmPassword() {
        const password = document.getElementById('signup-password').value;
        const confirmPasswordField = document.getElementById('signup-cpassword');
        
        confirmPasswordField.disabled = password.length < 8;
        enableSubmitButton();
    }

    function enableSubmitButton() {
        const password = document.getElementById('signup-password').value;
        const confirmPassword = document.getElementById('signup-cpassword').value;
        const submitButton = document.getElementById('signup-button');
        
        const isMatching = password === confirmPassword && password.length >= 8;
        submitButton.disabled = !isMatching;
        
        if (isMatching) {
            submitButton.classList.remove('cursor-not-allowed', 'bg-gray-500', 'text-gray-300');
            submitButton.classList.add('bg-primary', 'text-secondary', 'hover:bg-primary-passive');
        } else {
            submitButton.classList.add('cursor-not-allowed', 'bg-gray-500', 'text-gray-300');
            submitButton.classList.remove('bg-primary', 'text-secondary', 'hover:bg-primary-passive');
        }
    }
</script>
    