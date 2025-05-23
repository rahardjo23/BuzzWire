<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Politik' => 'Berita dan analisis tentang peristiwa dan kebijakan politik',
            'Teknologi' => 'Berita teknologi terbaru, ulasan, dan inovasi',
            'Kesehatan' => 'Berita medis, tips kesehatan, dan penelitian kesehatan',
            'Olahraga' => 'Berita olahraga, hasil, dan analisis',
            'Kriminal' => 'Berita kriminal, investigasi, dan proses hukum',
            'Sains' => 'Penemuan ilmiah, penelitian, dan inovasi',
            'Ekonomi' => 'Berita bisnis dan ekonomi, analisis pasar',
            'Wisata' => 'Destinasi wisata, tips, dan pengalaman perjalanan',
        ];

        foreach ($categories as $name => $description) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $description,
            ]);
        }
    }
}