<?php

namespace Database\Seeders;

use App\Models\SupplierModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SupplierModel::create(
            [
                'supplier_name' => 'supplier 1',
                'email' => 'supplier1@gmail.com',
                'contact_no' => '09383782459',
            ]
          );
        SupplierModel::create(
            [
                'supplier_name' => 'supplier 2',
                'email' => 'supplier2@gmail.com',
                'contact_no' => '093837824768',
            ]
          );
    }
}
