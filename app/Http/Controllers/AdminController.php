<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Exception;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            try {
                $admins = Admin::where('id', '!=', 1)->get();
                return datatables()->of($admins)
                    ->addColumn('actions', function ($row) {
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
            } catch (Exception $e) {
                return response()->json(['error' => 'Failed to fetch admins: ' . $e->getMessage()], 500);
            }
        }

        return view('admins.index');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|unique:admins,name',
                'email' => 'required|email|unique:admins,email',
                'password' => 'required|min:8',
            ]);

            $admin = new Admin();
            $admin->name = $validatedData['name'];
            $admin->email = $validatedData['email'];
            $admin->password = bcrypt($validatedData['password']);
            $admin->save();

            return redirect()->route('admins.index')->with('success', 'Admin added successfully');
        } catch (QueryException $e) {
            return redirect()->route('admins.index')->with('error', 'Database error: ' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('admins.index')->with('error', 'An unexpected error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|unique:admins,name,' . $id,
                'email' => 'required|email|unique:admins,email,' . $id,
            ]);

            $admin = Admin::findOrFail($id);
            $admin->name = $validatedData['name'];
            $admin->email = $validatedData['email'];
            $admin->save();

            return redirect()->route('admins.index')->with('success', 'Admin updated successfully');
        } catch (QueryException $e) {
            return redirect()->route('admins.index')->with('error', 'Database error: ' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('admins.index')->with('error', 'An unexpected error occurred: ' . $e->getMessage());
        }
    }

    public function destroy(Admin $admin)
    {
        try {
            $admin->delete();
            return redirect()->route('admins.index')->with('success', 'Admin deleted successfully');
        } catch (QueryException $e) {
            return redirect()->route('admins.index')->with('error', 'Database error: ' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('admins.index')->with('error', 'An unexpected error occurred: ' . $e->getMessage());
        }
    }
}
