<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create([
            'brandname' => "Audi",
        ]);
        Brand::create([
            'brandname' => "BMW",
        ]);
        Brand::create([
            'brandname' => "Honda",
        ]);
        Brand::create([
            'brandname' => "Mazda",
        ]);
        Brand::create([
            'brandname' => "Mercedes",
        ]);
        Brand::create([
            'brandname' => "Mini",
        ]);
        Brand::create([
            'brandname' => "Porsche",
        ]);
        Brand::create([
            'brandname' => "Toyota",
        ]);
    }
}
