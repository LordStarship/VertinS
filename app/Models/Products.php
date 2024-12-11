<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
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
        ];
    
        if (!$isEdit) {
            $rules['images'] = 'required|array|min:1'; // At least one image is required on creation
            $rules['images.*'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        } else {
            $rules['images.*'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'; // Optional for edit
        }
    
        return $rules;
    }
    

    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'category_product', 'product_id', 'category_id');
    }
    public function pictures()
    {
        return $this->hasMany(Pictures::class, 'product_id'); // Specify 'product_id' as the foreign key
    }
    public function picture()
    {
        return $this->belongsTo(Pictures::class, 'picture_id')
                    ->where('is_default', 1);
    }

    public function thumbnail()
    {
        return $this->hasOne(Pictures::class, 'product_id', 'id')->where('is_default', 1); // Correct key

    }
}