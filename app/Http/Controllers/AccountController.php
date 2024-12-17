<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return view('accounts.index');
    }

    public function update(Request $request, $account)
    {
        $id = auth('web')->id();

        if ($id != $account) {
            abort(403, 'Unauthorized action.');
        }
    
        $validatedData = $request->validate([
            'name' => 'required|string|unique:admins,name,' . $id,
            'email' => 'required|email|unique:admins,email,' . $id,
        ]);
    
        $admin = Admin::find($id);
        $admin->name = $validatedData['name'];
        $admin->email = $validatedData['email'];
        $admin->save();
    
        session(['username' => $admin->name, 'useremail' => $admin->email]);
    
        return redirect()->route('accounts.index');
    }
}
