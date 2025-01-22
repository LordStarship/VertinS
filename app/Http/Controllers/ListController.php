<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;

class ListController extends Controller
{
    public function index($category_id = null)
    {
        if ($category_id) {
            // Fetch specific category and its products
            $category = Category::with('products')->find($category_id);

            if (!$category || $category->products->isEmpty()) {
                abort(404, 'Category not found or no products available.');
            }

            return view('list', compact('category'));
        } else {
            // Fetch all categories that have products
            $categories = Category::with('products')->get()->filter(function ($category) {
                return $category->products->isNotEmpty();
            });

            return view('list', compact('categories'));
        }
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $categoryId = $request->get('category_id');

        try {
            // Start the query on products
            $productsQuery = Product::with('thumbnail');

            if ($categoryId) {
                // Filter products that belong to the category via the pivot table
                $productsQuery->whereHas('categories', function ($q) use ($categoryId) {
                    $q->where('categories.id', $categoryId);
                });
            }

            if ($query) {
                // Filter products by title
                $productsQuery->where('title', 'like', "%{$query}%");
            }

            $products = $productsQuery->get();

            $formattedProducts = $products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'title' => $product->title,
                    'thumbnail' => [
                        'path' => $product->thumbnail->path,
                    ],
                    'formatted_price' => formatRupiah($product->price), // Format the price
                ];
            });
    
            return response()->json($formattedProducts);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request.'], 500);
        }
    }
}
