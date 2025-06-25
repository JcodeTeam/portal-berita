<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\Author;
use Illuminate\Support\Str;
use App\Models\NewsCategory;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker       = Faker::create();

        // Ambil semua ID author dan category yang sudah ada
        $authorIds   = Author::pluck('id')->all();
        $categoryIds = NewsCategory::pluck('id')->all();

        if (empty($authorIds) || empty($categoryIds)) {
            $this->command->info('Seeder gagal: pastikan Anda sudah menjalankan AuthorSeeder dan NewsCategorySeeder.');
            return;
        }

        $imageFiles = ['dummy1.jpg', 'dummy2.jpg', 'dummy3.jpg', 'dummy4.jpg'];

        // Buat 20 berita
        foreach (range(1, 20) as $i) {
            $title = $faker->sentence(6, true);

            News::create([
                'news_id'      => str_pad(mt_rand(1, 999999999), 9, '0', STR_PAD_LEFT),
                'is_published' => $faker->boolean(80),
                'author_id'    => $faker->randomElement($authorIds),
                'category_id'  => $faker->randomElement($categoryIds),
                'title'        => $title,
                'slug'         => Str::slug($title) . '-' . Str::random(5),
                'image'        => $faker->randomElement($imageFiles),
                'content'      => $faker->paragraphs(5, true),
            ]);
        }
    }
}
