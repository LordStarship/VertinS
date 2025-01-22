<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Media;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        try {
            $adminId = auth('web')->id();
            if ($request->ajax()) {
                $media = Media::where('admin_id', $adminId)->get();
                return DataTables::of($media)
                    ->addColumn('actions', function ($row) {
                        $editData = json_encode(['id' => $row->id, 'social_media' => $row->social_media, 'url' => $row->url]);  
                        return '
                            <div class="flex items-center justify-center">
                                <a href="javascript:void(0);" onclick="openEditMediaModal(' . htmlspecialchars($editData) . ')" class="p-2 bg-gray-100 hover:bg-gray-400 rounded-md">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="openDeleteMediaModal(\'' . $row->id . '\', \'' . $row->name . '\')" class="p-2 bg-gray-100 hover:bg-gray-400 rounded-md">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </div>
                        ';
                    })
                ->rawColumns(['actions'])
                ->make(true);
            }
            return view('accounts.index');
        } catch (\Exception $e) {
            return redirect()->route('accounts.index')->with('error', 'Failed to load media data. Error: '. $e->getMessage());
        }
    }

    public function update(Request $request, $account)
    {
        try {
            $id = auth('web')->id();

            if ($id != $account) {
                return redirect()->route('accounts.index')->with('error', 'Unauthorized action.');
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

            return redirect()->route('accounts.index')->with('success', 'Account updated successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('accounts.index')->with('error', 'Failed to update account. Error: '. $e->getMessage());
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $id = auth('web')->id();

            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|min:8',
            ]);

            $admin = Admin::find($id);

            if (!Hash::check($request->old_password, $admin->password)) {
                return back()->with('error', 'The old password is incorrect.');
            }

            $admin->password = Hash::make($request->new_password);

            $admin->save();

            return redirect()->route('accounts.index')->with('success', 'Password changed successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Failed to change password. Error: '. $e->getMessage());
        }
    }
}
