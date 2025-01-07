<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Picture;
use App\Models\Media;

class DetailController extends Controller
{
    public function index($product_id)
    {
        // Fetch the product
        $product = Product::findOrFail($product_id);

        // Increment the view count
        $product->increment('count_view');

        // Fetch the images for the product
        $pictures = Picture::where('product_id', $product_id)->get();

        // Get the default image (is_default = true)
        $defaultPicture = $pictures->where('is_default', true)->first();

        // Fetch social media links for the product's admin
        $medias = Media::where('admin_id', $product->admin_id)->get();

        return view('product', compact('product', 'pictures', 'defaultPicture', 'medias'));
    }

    public function incrementMessageCount($id)
    {
        $product = Product::findOrFail($id);
        $product->increment('message_count');
        return response()->json(['success' => true]);
    }
}
