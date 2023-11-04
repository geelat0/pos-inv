<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(
            [
                'first_name' => 'admin',
                'middle_name' => 'admin',
                'last_name' => 'admin',
                'gender' => 'female',
                'mobile' => '09123456789',
                'email' => 'admin@example.com',
                'user_role' => '1',
                'password' => Hash::make('123456'),
            ]
          );
          User::create(
            [
                'first_name' => 'manager',
                'middle_name' => 'manager',
                'last_name' => 'manager',
                'gender' => 'male',
                'mobile' => '09123456789',
                'email' => 'manager@example.com',
                'user_role' => '2',
                'password' => Hash::make('123456'),
            ]
            );
          User::create(
            [
                'first_name' => 'employee',
                'middle_name' => 'employee',
                'last_name' => 'employee',
                'gender' => 'male',
                'mobile' => '09123456789',
                'email' => 'employee@example.com',
                'user_role' => '3',
                'password' => Hash::make('123456'),
            ]
            );
    }
}
