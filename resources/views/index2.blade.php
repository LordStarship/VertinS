<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VertinS | Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="login">
            <div class="flex-container flex-col">
                <div class="flex-container centered">
                    <img class="login-logo" src="img/logo.png">
                    <p class="logo-name">VertinS</p>
                </div>
                <div class="login-left">
                    <div style="flex-container flex-col">
                        <div class="login-top">
                            <div class="flex-container flex-col centered">
                                <h2 class="login-title">Welcome 👋</h2>
                                <p class="login-subtitle">Login untuk memasuki dashboard admin.</p>
                            </div>                            
                        </div>
                        <div class="login-bottom">
                            <div class="flex-container flex-row centered">
                                <a class="login-link" href="{{ route('index') }}">
                                    <div class="flex-container flex-col centered">
                                        <p class="login-link-subtitle subtitle-active">Login</p>
                                        <hr class="line-break line-active" />
                                    </div>
                                </a>
                                <a class="login-link" href="{{ route('index') }}">
                                    <div class="flex-container flex-col centered">
                                        <p class="login-link-subtitle">Sign Up</p>
                                        <hr class="line-break" />
                                    </div>
                                </a>
                            </div> 
                        </div> 
                    </div class="login-form">
                        <form action="{{ route('login') }}" method="post"> 
                            @csrf
                            <div class="form-group">
                                <label for="nameandemail">Name or Email</label>
                                <input type="text" name="nameandemail" id="nameandemail" placeholder="Enter name or email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" placeholder="Enter password">
                            </div>
                            <button type="submit" class="btn">Login</button>
                        </form>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</body>
</html>