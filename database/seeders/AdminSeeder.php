<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'name' => 'Admin User',
            'email' => 'admin@yakan.com',
            'password' => Hash::make('admin123'), // this is the password you will use
            'role' => 'admin',
        ]);
    }
}
