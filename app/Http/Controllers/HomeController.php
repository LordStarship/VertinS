<?php

namespace App\Http\Controllers;

use App\Models\Admins; // Ensure you have this model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch all admins from the database
        $admins = Admins::all();
        return view('home', compact('admins'));
    }

    public function index2()
    {
        return view('index2');
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
    
        $admin = new Admins();
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->password = Hash::make($request->input('password'));
    
        if ($admin->save()) {
            return redirect()->route('home')->with('success', 'Admin added successfully.');
        } else {
            return redirect()->route('home')->with('error', 'Failed to add admin.');
        }
    }

    public function edit(Request $request, $id)
    {
        // Fetch the admin by ID
        $admin = Admins::findOrFail($id);
        
        return response()->json($admin); // Return admin details as JSON (for the edit form)
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|min:8|confirmed' // Password confirmation
        ]);

        $admin = Admins::findOrFail($id);
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');

        // Hash password if provided
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->input('password'));
        }

        $admin->save();

        return redirect()->route('home')->with('success', 'Admin updated successfully.');
    }

    public function delete($id)
    {
        if ($id == 1) {
            return redirect()->back()->with('error', 'Cannot delete the main admin.');
        }
    
        Admins::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Admin deleted successfully.');
    }
}
