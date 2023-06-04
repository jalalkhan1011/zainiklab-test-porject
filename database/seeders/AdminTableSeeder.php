<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com', 
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com', 
            'password' => Hash::make('123456789'),
            'user_type' => 'Admin',
        ]);
    }
}
