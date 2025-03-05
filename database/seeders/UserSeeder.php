<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 2,
                'name' => 'Edward Wijaya',
                'email' => 'edwardwijaya08@gmail.com',
                'password' => Hash::make('12345678'),
                'is_admin' => false
            ],
            [
                'id' => 3,
                'name' => 'Allycia',
                'email' => 'allyciametta@gmail.com',
                'password' => Hash::make('12345678'),
                'is_admin' => false
            ]
        ]);
    }
}
