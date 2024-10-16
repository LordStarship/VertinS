<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        .container {
            width: 900px;
            height: 500px;
            display: flex;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            background-color: white;
        }
        .left {
            background: linear-gradient(to bottom left, #427D9D, #164863);
            color: white;
            padding: 60px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .left h1 {
            margin-top: 0;
            font-size: 36px;
            /* font-weight: 600; */
        }
        .left p {
            font-size: 18px;
            /* font-weight: 400;
            margin: 20px 0 0; */
        }
        .right {
            padding: 60px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .right h2 {
            margin-top: 0;
            font-size: 30px;
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            /* font-size: 14px; */
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            /* font-size: 14px; */
        }
        .btn {
            background: linear-gradient(to bottom left, #427D9D, #164863);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            /* font-weight: 600; */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left">
            <h1>Halooo!</h1>
            <p>Untuk tetap terhubung dengan kami, silahkan masuk dengan akun anda</p>
        </div>
        <div class="right">
            <h2>Sign In</h2>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nameandemail">Email or Username</label>
                    <input type="text" id="nameandemail" name="nameandemail" required>
                    @error('nameandemail')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn">Sign In</button>
            </form>
        </div>
    </div>
</body>
</html>