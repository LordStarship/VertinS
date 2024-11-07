<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'category_product', 'product_id', 'category_id');
    }
        public function pictures()
    {
        return $this->hasMany(Pictures::class, 'product_id'); // Specify 'product_id' as the foreign key
    }
}
