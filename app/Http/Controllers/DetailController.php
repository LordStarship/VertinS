<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index($id)
    {
        $product = Product::find($id);
        return view('product')
        ->with('title', "Product Details")
        ->with('product', $product);
    }   
}
