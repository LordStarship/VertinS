<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $admins = Admin::where('id', '!=', 1)->get();
            return datatables()->of($admins)
                    ->addColumn('actions', function ($row) {
                    // Encode the data to JSON format
                    $editData = json_encode(['id' => $row->id, 'name' => $row->name, 'email' => $row->email]);                                        
                    return '
                        <div class="flex items-center justify-center">
                            <a href="javascript:void(0);" onclick="openEditAdminModal(' . htmlspecialchars($editData) . ')" class="p-2 bg-gray-100 hover:bg-gray-400 rounded-md">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="javascript:void(0);" onclick="openDeleteAdminModal(\'' . $row->id . '\')" class="p-2 bg-gray-100 hover:bg-gray-400 rounded-md">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </div>
                    ';                                        
                })
            ->rawColumns(['actions'])
            ->make(true);
        }
        return view('admins.index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:admins,name',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:8',
        ]);

        $admin = new Admin();
        $admin->name = $validatedData['name'];
        $admin->email = $validatedData['email'];
        $admin->password = bcrypt($validatedData['password']);
        $admin->role = 1;
        $admin->save();

        return redirect()->route('admins.index')->with('success', 'Admin added successfully');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:admins,name,' . $id,
            'email' => 'required|email|unique:admins,email,' . $id,
        ]);
    
        $admin = Admin::findOrFail($id);
        $admin->name = $validatedData['name'];
        $admin->email = $validatedData['email'];
        $admin->save();
        
        return redirect()->route('admins.index')->with('success', 'Admin updated successfully');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admins.index')->with('success', 'Admin deleted successfully');
    }
}