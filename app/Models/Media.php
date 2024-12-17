<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Media extends Model
{
    use HasFactory;

    protected $table = 'medias';
    
    protected $fillable = ['social_media', 'url', 'admin_id'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}

