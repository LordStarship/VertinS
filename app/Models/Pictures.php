<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pictures extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'path', 'is_default', 'product_id', 'admin_id'];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id'); // Foreign key is 'product_id'
    }
}
