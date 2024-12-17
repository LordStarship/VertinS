<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'path', 'is_default', 'product_id', 'admin_id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id'); 
    }
}
