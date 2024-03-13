<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'email' => 'admin@gmail.com',
            'name' => 'administrator',
            'username' => 'administrator',
            'status' => 'aktiv',
            'password' => Hash::make('password')
        ]);

        $admin->assignRole('superadmin');
    }
}
