<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Author;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        // Ambil hanya user dengan role_id = 2
        $users = User::where('role_id', 2)->get();

        foreach ($users as $user) {
            // Jika author untuk user ini belum ada, buat baru
            if (!$user->author) {
                Author::create([
                    'user_id'       => $user->id,
                    'username'      => $faker->unique()->userName,
                    'employee_code' => strtoupper($faker->bothify('EMP###')),
                    'bio'           => $faker->sentence,
                ]);
            }
        }
    }
}
