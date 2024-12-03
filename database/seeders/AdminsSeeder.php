<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admins;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admins::updateOrCreate(
            ['email' => 'Timo@gmail.com'], // Kriteria pencarian
            [
                'name' => 'Timmo', // Data yang akan diperbarui/dibuat
                'password' => Hash::make('ws123'),
            ]
        );
    }
}
