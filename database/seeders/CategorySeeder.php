<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'IT & Software',
            'Marketing',
            'Design',
            'Finance',
            'Healthcare',
            'Education',
            'Engineering',
            'Customer Service',
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}