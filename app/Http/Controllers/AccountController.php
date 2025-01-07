<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Media;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $adminId = auth('web')->id();
        if ($request->ajax()) {
            $media = Media::where('admin_id', $adminId)->get();
            return DataTables::of($media)
                ->addColumn('actions', function ($row) {
                    $editData = json_encode(['id' => $row->id, 'social_media' => $row->social_media, 'url' => $row->url]);  
                    return '
                        <div class="flex items-center justify-center">
                            <a href="javascript:void(0);" onclick="openEditMediaModal(' . htmlspecialchars($editData) . ')" class="p-2 bg-gray-100 hover:bg-gray-200 rounded-md">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="javascript:void(0);" onclick="openDeleteMediaModal(\'' . $row->id . '\', \'' . $row->name . '\')" class="p-2 bg-gray-100 hover:bg-gray-200 rounded-md">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </div>
                    ';
                })
            ->rawColumns(['actions'])
            ->make(true);
        }
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
