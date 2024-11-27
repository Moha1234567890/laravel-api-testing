<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([

            "name_ar" => "ملابس",
            "name_en" => "clothes",
        ]);

        Category::create([

            "name_ar" => "أحديه",
            "name_en" => "shoes",
        ]);

        Category::factory()->count(3)->create();
    }
}
