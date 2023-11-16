<?php

namespace Database\Seeders;

use App\Models\CategoryModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryModel::create(
            [
                'category_name' => 'category 1',
            ]
          );
        CategoryModel::create(
            [
                'category_name' => 'category 2',
            ]
          );
    }
}
