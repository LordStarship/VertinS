<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admins;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'nameandemail' => 'required',
            'password' => 'required',
        ]);

        $login = $request->input('nameandemail');
        $password = $request->input('password');

        // Determine if the login input is an email or a name
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        // Fetch the user from the database
        $user = Admins::where($fieldType, $login)->first();

        // Check if user exists
        if (!$user) {
            return back()->withErrors([
                'nameandemail' => 'Invalid email or username.',
            ]);
        }

        // Use Hash::check to verify the password
        if (!Hash::check($password, $user->password)) {
            return back()->withErrors([
                'password' => 'Invalid password.',
            ]);
        }

        // Regenerate session to prevent fixation
        $request->session()->regenerate();

        // Log the user in
        Auth::login($user);

        // Store specific user data in the session
        session()->put([
            'username' => $user->name,
            'useremail' => $user->email,
        ]);

        return redirect()->route('products');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
