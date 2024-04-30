<?php

namespace Database\Seeders;

use App\Models\Category;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (Category::query()->count() == 0) {
            Category::factory(5)
                ->create();
        }

        Product::factory(50)
            ->create();

    }
}
