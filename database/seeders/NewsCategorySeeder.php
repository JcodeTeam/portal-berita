<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\NewsCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            'Nasional',
            'Internasional',
            'Politik',
            'Ekonomi',
            'Teknologi',
            'Olahraga',
            'Hiburan',
            'Kesehatan',
        ];

        foreach ($categories as $title) {
            NewsCategory::create([
                'title' => $title,
                'slug' => Str::slug($title),
            ]);
        }
    }
}
