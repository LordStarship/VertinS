<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $admins = Admins::where('id', '!=', 1)->get();
            return datatables()->of($admins)
                    ->addColumn('actions', function ($row) {
                    // Encode the data to JSON format
                    $editData = json_encode(['id' => $row->id, 'name' => $row->name, 'email' => $row->email]);                                        
                    return '
                        <div class="flex items-center justify-center">
                            <a href="javascript:void(0);" onclick="openEditAdminModal(' . htmlspecialchars($editData) . ')" class="p-2 bg-gray-100 hover:bg-gray-200 rounded-md">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="javascript:void(0);" onclick="openDeleteAdminModal(\'' . $row->id . '\')" class="p-2 bg-gray-100 hover:bg-gray-200 rounded-md">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </div>
                    ';                                        
                })
            ->rawColumns(['actions'])
            ->make(true);
        }
        return view('account');
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
