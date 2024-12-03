<?php

namespace App\Http\Controllers;

use App\Models\Categories; 
use App\Models\Products;
use App\Models\Pictures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

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
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="javascript:void(0);" onclick="openDeleteModal(\'' . $row->id . '\', \'' . $row->name . '\')" class="p-2 bg-gray-100 hover:bg-gray-200 rounded-md">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </div>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('products.index');
    }

    public function create()
    {
        $categories = Categories::all();
            return view('products.create', compact('categories'));
        }

    public function store(Request $request)
    {
        Log::info('Store method called.');
        Log::info('Request data:', $request->all());

        try {
            $validated = $request->validate(Products::rules());
            Log::info('Validation passed.', $validated);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed.', $e->errors());
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $product = Products::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'admin_id' => Auth::guard('web')->id(),
        ]);

        Log::info('Product created: ', $product->toArray());

        $product->categories()->sync($validated['categories']);

        foreach ($validated['images'] as $index => $image) {
            Log::info('Processing image:', ['name' => $image->getClientOriginalName()]);
            $path = $image->store('pics', 'public');
            Pictures::create([
                'name' => $image->getClientOriginalName(),
                'path' => $path,
                'is_default' => $index === 0,
                'product_id' => $product->id,
                'admin_id' => Auth::guard('web')->id(),
            ]);
        }

        Log::info('Pictures saved.');

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

}
