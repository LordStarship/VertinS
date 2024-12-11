<?php

namespace App\Http\Controllers;

use App\Models\Products;

use Illuminate\Http\Request;

class ListController extends Controller
{
    public function index()
    {
        $products = Products::with('thumbnail')->get();

        

        return view('avalestial')
            ->with('title', "Ava'Lestial Store")
            ->with('products', $products);
    }   
}
