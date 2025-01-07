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
}
