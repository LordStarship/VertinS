<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::withCount('products')->get();
        return view('categories', compact('categories'));
    }

    public function create()
    {
        return view('categories_add');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create the new category
        $category = new Categories();
        $category->name = $request->input('name');
        $category->admin_id = Auth::guard('web')->id(); // Assuming the logged-in admin's ID is used
        $category->product_id = $request->input('product_id') ?? null;

        if ($category->save()) {
            return redirect()->route('categories')->with('success', 'Category added successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to add category.');
        }
    }

    public function update(Request $request, $id)
    {
        // Validate the category name
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z0-9 ]+$/',
        ]);

        // Find the category by ID and update the name
        $category = Categories::findOrFail($id);
        $category->name = $request->name;
        $category->save();

        // Return a response to indicate success
        return response()->json(['message' => 'Category updated successfully']);
    }

    public function destroy($id)
    {
        // Find the category by ID
        $category = Categories::find($id);

        // Check if category exists
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // Delete the category
        $category->delete();

        // Return success response
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
