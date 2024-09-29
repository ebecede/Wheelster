<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Admin Main',
            'phoneNumber' => '1234567890',
            'email' => 'admin@initial.com',
            'address' => '123 Admin St',
            'gender' => 'male',
            'DOB' => '2001-01-01',
            'role' => 'admin',
            'password' => bcrypt('adminPassword'),
        ]);
    }
}
