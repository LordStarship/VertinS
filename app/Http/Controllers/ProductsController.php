<?php

namespace App\Http\Controllers;

use App\Models\Categories; 
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Products::select('products.*')
                ->addSelect([
                    'categories_count' => DB::table('categories')
                        ->join('category_product', 'categories.id', '=', 'category_product.category_id')
                        ->whereColumn('category_product.product_id', 'products.id')
                        ->selectRaw('count(*)'),

                    'pictures_count' => DB::table('pictures')
                        ->whereColumn('pictures.admin_id', 'products.admin_id')
                        ->selectRaw('count(*)'),
                ]);

            return DataTables::of($products)
                ->addColumn('actions', function ($row) {
                    return '
                        <div class="flex items-center justify-center">
                            <a href="javascript:void(0);" onclick="openEditModal(\'' . $row->id . '\', \'' . $row->name . '\')" class="p-2 bg-gray-100 hover:bg-gray-200 rounded-md">
                                <img src="' . asset('storage/img/edit-logo.png') . '" alt="Edit" class="w-5 h-5">
                            </a>
                            <a href="javascript:void(0);" onclick="openDeleteModal(\'' . $row->id . '\', \'' . $row->name . '\')" class="p-2 bg-gray-100 hover:bg-gray-200 rounded-md">
                                <img src="' . asset('storage/img/delete-logo.png') . '" alt="Delete" class="w-5 h-5">
                            </a>
                        </div>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('products');
    }

    public function create()
    {
        $categories = Categories::all();
        return view('products_add', compact('categories'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'categories' => 'required|array',
            'price' => 'required|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'isDefault' => 'required|boolean',
        ]);

        // Create the product
        $product = Products::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
        ]);

        // Attach categories
        $product->categories()->attach($validated['categories']);

        // Process and save images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('pics', $imageName, 'public');
                $product->pictures()->create([
                    'name' => $imageName,
                    'path' => $imagePath,
                    'isDefault' => $key == 0 && $validated['isDefault'], // First image is default
                ]);
            }
        }

        return redirect()->route('products')->with('success', 'Product added successfully');
    }

}
