<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 30; $i++) {
            Products::updateOrCreate([
                'id' => $i,
                'admin_id' => '1',
                'title' => 'JJK',
                'description' => 'lore ipsum',
                'price' => '10000',
                'status' => '1',
            ]);
        }
    }
}
