<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::statement('ALTER TABLE roles AUTO_INCREMENT = 1');

        Role::insert([
            ['name' => 'Admin'],
            ['name' => 'Redaksi'],
            ['name' => 'User'],
        ]);

    }
}
