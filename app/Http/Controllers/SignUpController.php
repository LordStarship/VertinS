<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admins;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller
{
    public function index() {
        $admins = Admins::all();
        return view('signup', compact('admins'));
    }
    public function signup(Request $request)
    {
        // Validate the form data
        $request->validate([
            'username' => 'required|string|max:255|unique:admins,name',
            'email' => 'required|string|email|max:255|unique:admins,email',
            'signup-password' => 'required|string|min:8|same:signup-cpassword',
            'signup-cpassword' => 'required|string|min:8',
        ], [
            'username.unique' => 'The username has already been taken.',
            'email.unique' => 'The email has already been taken.',
            'signup-password.same' => 'Passwords do not match.',
        ]);

        // Hash the password
        $hashedPassword = Hash::make($request->input('signup-password'));

        // Store the new admin
        Admins::create([
            'name' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => $hashedPassword,
        ]);

        // Redirect to the index page with a success message
        return redirect()->route('index')->with('success', 'Account created successfully!');
    }
}
