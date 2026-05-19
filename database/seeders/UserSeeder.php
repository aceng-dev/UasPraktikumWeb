<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@anokind.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'balance' => 0,
        ]);

        User::create([
            'name' => 'Sarah Pembaca',
            'email' => 'reader@anokind.com',
            'password' => Hash::make('password123'),
            'role' => 'reader',
            'balance' => 100000,
        ]);

        User::create([
            'name' => 'Budi Penulis',
            'email' => 'author@anokind.com',
            'password' => Hash::make('password123'),
            'role' => 'author',
            'balance' => 50000,
        ]);
    }
}