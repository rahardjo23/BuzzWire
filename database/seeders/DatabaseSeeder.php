<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tambahkan seeder untuk user
        \App\Models\User::factory(10)->create();
        
        // Tambahkan seeder untuk category
        $this->call([
            CategorySeeder::class,
            ArticleSeeder::class,
            CommentSeeder::class,
        ]);
    }
}