<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Never crate more than 25 products because there are only 12 unique names declared at the seeder
        \App\Models\Product::factory(20)->create();
    }
}
