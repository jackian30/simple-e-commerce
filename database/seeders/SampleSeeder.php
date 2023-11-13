<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SampleSeeder extends Seeder
{
    public function run()
    {
        $this->call(ProductSeeder::class);
        $this->call(ProductImageSeeder::class);
    }
}
