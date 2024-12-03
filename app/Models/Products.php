<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'price', 'admin_id'];

    public static function rules()
    {
        return [
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'price' => 'required|numeric|min:0',
            'images' => 'required|array|min:1|max:5',
            'images.*' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'category_product', 'product_id', 'category_id');
    }
    public function pictures()
    {
        return $this->hasMany(Pictures::class, 'product_id'); // Specify 'product_id' as the foreign key
    }
}
