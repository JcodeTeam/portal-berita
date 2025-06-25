<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil role dari database
        $adminRole = Role::where('name', 'admin')->first();
        $redaksiRole = Role::where('name', 'redaksi')->first();
        $userRole = Role::where('name', 'user')->first();

        // Admin
        User::create([
            'role_id' => $adminRole->id,
            'name' => 'Admin Master',
            'email' => 'admin@example.com',
            'avatar' => null,
            'password' => Hash::make('123456'),
        ]);

        // Redaksi
        User::create([
            'role_id' => $redaksiRole->id,
            'name' => 'Redaksi Satu',
            'email' => 'redaksi@example.com',
            'avatar' => null,
            'password' => Hash::make('123456'),
        ]);

        User::create([
            'role_id' => $redaksiRole->id,
            'name' => 'Redaksi Dua',
            'email' => 'redaksi2@example.com',
            'avatar' => null,
            'password' => Hash::make('123456'),
        ]);

        // User Biasa
        User::create([
            'role_id' => $userRole->id,
            'name' => 'User Umum',
            'email' => 'user@example.com',
            'avatar' => null,
            'password' => Hash::make('123456'),
        ]);
    }
}
