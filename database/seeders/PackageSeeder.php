<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Package::create([
            'price' => 990,
            'amount' => 1000,
        ]);
        Package::create([
            'price' => 1990,
            'amount' => 2000,
        ]);
        Package::create([
            'price' => 3990,
            'amount' => 5000,
        ]);
        Package::create([
            'price' => 6990,
            'amount' => 10000,
        ]);
        Package::create([
            'price' => 10000,
            'amount' => 30000,
        ]);
        Package::create([
            'price' => 29900,
            'amount' => 100000,
        ]);
    }
}
