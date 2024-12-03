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
        Pictures::updateOrCreate([
            'id' => '3',
            'admin_id' => '1',
            'name' => 'profiles',
            'path' => 'storage/img/SK3.',
        ]);
    }
}
