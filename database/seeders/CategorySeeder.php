<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // NewsAPI Compatible Categories
        $categories = [
            'Business' => 'Business and economic news, market analysis, and financial updates',
            'Entertainment' => 'Entertainment news, celebrity updates, lifestyle, and travel content',
            'General' => 'General news, politics, crime, and current affairs',
            'Health' => 'Health and medical news, wellness tips, and health research',
            'Science' => 'Scientific discoveries, research, and innovations',
            'Sports' => 'Sports news, results, competitions, and athletic events',
            'Technology' => 'Latest technology news, reviews, and digital innovations',
        ];

        foreach ($categories as $name => $description) {
            Category::create([
                'name' => $name,
                'description' => $description,
            ]);
        }
    }
}