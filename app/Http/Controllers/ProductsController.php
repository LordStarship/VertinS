<?php

namespace App\Http\Controllers;

use App\Models\Categories; 
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index()
    {
        // Fetch all admins from the database
        $products = Products::select('products.*')
        ->addSelect([
            'categories_count' => DB::table('categories')
                ->whereColumn('categories.product_id', 'products.id')
                ->selectRaw('count(*)'),
            'pictures_count' => DB::table('pictures')
                ->whereColumn('pictures.product_id', 'products.id')
                ->selectRaw('count(*)')
        ])
        ->get();
        return view('products', compact('products'));
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
