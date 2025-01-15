<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::withCount('products')->get();
            return DataTables::of($categories)
                ->addColumn('actions', function ($row) {
                    return '
                        <div class="flex items-center justify-center">
                            <a href="javascript:void(0);" onclick="openEditModal(\'' . $row->id . '\', \'' . $row->name . '\')" class="p-2 bg-gray-100 hover:bg-gray-400 rounded-md">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="javascript:void(0);" onclick="openDeleteModal(\'' . $row->id . '\', \'' . $row->name . '\')" class="p-2 bg-gray-100 hover:bg-gray-400 rounded-md">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </div>
                    ';
                })
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('categories.index');
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = new Category();
        $category->name = $request->input('name');
        $category->admin_id = Auth::guard('web')->id(); 

        if ($category->save()) {
            return redirect()->route('categories.index')->with('success', 'Category added successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to add category.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z0-9 ]+$/',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();

        return response()->json(['message' => 'Category updated successfully']);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
