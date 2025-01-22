<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'price', 'admin_id'];

    public static function rules($isEdit = false)
    {
        $rules = [
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'images' => 'array|max:4',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    
        if (!$isEdit) {
            $rules['images'] = 'required|array|min:1|max:4'; // At least one image is required on creation, maximum 4
        }
    
        return $rules;
    }
    

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }
    public function pictures()
    {
        return $this->hasMany(Picture::class, 'product_id');
    }
    public function picture()
    {
        return $this->belongsTo(Picture::class, 'picture_id')
                    ->where('is_default', 1);
    }
    public function thumbnail()
    {
        return $this->hasOne(Picture::class, 'product_id', 'id')->where('is_default', 1); 
    }
}