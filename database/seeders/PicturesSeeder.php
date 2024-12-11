<?php

namespace Database\Seeders;

use App\Models\Pictures;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PicturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 8; $i < 30; $i++) {
        Pictures::updateOrCreate([
            'id' => $i,
            'admin_id' => '1',
            'product_id' => $i,
            'is_default' => '1',
            'name' => 'profiles',
            'path' => 'storage/img/SK1.jpg',
        ]);
    }
    }
}
