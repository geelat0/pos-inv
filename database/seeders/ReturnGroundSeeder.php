<?php

namespace Database\Seeders;

use App\Models\ReturnGroundsModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReturnGroundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ReturnGroundsModel::create(
            [
                'title' => 'Defective or Faulty Product',
                'desc' => 'The product is damaged, malfunctioning, or does not meet quality standards.',
            ]
          );
        ReturnGroundsModel::create(
            [
                'title' => 'Wrong Item Shipped',
                'desc' => 'The customer receives a product that is different from what they ordered.',
            ]
          );
        ReturnGroundsModel::create(
            [
                'title' => 'Damage During Shipping',
                'desc' => 'The product is damaged upon buying.',
            ]
          );
    }
}
