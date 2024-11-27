<?php

namespace Database\Seeders;
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
        DB::table('products')->insert([
            'id' => '1',
            'admin_id' => '1',
            'picture_id' => '1',
            'title' => 'Shorekeeper Starter Account',
            'description' => 'lore ipsum',
            'price' => '10000',
            'status' => '1',
        ]);
    }
}
