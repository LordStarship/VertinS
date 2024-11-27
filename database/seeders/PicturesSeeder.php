<?php

namespace Database\Seeders;
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
        DB::table('pictures')->insert([
            'id' => '1',
            'admin_id' => '1',
            'name' => 'profile',
            'path' => 'storage/img/SK1.',
        ]);
    }
}
