<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function index()
    {
        $admins = Admins::where('id', '!=', 1)->get();
        return view('account', compact('admins'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:admins,name',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:8',
        ]);

        $admin = new Admins();
        $admin->name = $validatedData['name'];
        $admin->email = $validatedData['email'];
        $admin->password = bcrypt($validatedData['password']);
        $admin->save();

        return redirect()->route('accounts')->with('success', 'Admin added successfully');
    }
    public function updateCurrentAdmin(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:admins,name,' . auth('web')->id(),
            'email' => 'required|email|unique:admins,email,' . auth('web')->id(),
        ]);
    
        $admin = Admins::find(auth('web')->id());
        $admin->name = $validatedData['name'];
        $admin->email = $validatedData['email'];
        $admin->save();

        session(['username' => $admin->name, 'useremail' => $admin->email]);
    
        return redirect()->route('accounts');
    }
    
    public function updateAdmin(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:admins,name,' . $id,
            'email' => 'required|email|unique:admins,email,' . $id,
        ]);

        $admin = Admins::findOrFail($id);
        $admin->name = $validatedData['name'];
        $admin->email = $validatedData['email'];
        $admin->save();
        
        return redirect()->route('accounts')->with('success', 'Admin updated successfully');
    }

    public function destroy(Admins $admin)
    {
        $admin->delete();
        return redirect()->route('accounts')->with('success', 'Admin deleted successfully');
    }
}
