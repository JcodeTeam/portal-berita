<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            AuthorSeeder::class,
            NewsCategorySeeder::class,
            NewsSeeder::class,
        ]);

    }
}
