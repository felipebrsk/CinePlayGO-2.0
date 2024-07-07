<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Package, PackageType};

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
            'package_type_id' => PackageType::COIN_TYPE_ID,
        ]);
        Package::create([
            'price' => 1990,
            'amount' => 2000,
            'package_type_id' => PackageType::COIN_TYPE_ID,
        ]);
        Package::create([
            'price' => 3990,
            'amount' => 5000,
            'package_type_id' => PackageType::COIN_TYPE_ID,
        ]);
        Package::create([
            'price' => 6990,
            'amount' => 10000,
            'package_type_id' => PackageType::COIN_TYPE_ID,
        ]);
        Package::create([
            'price' => 10000,
            'amount' => 30000,
            'package_type_id' => PackageType::COIN_TYPE_ID,
        ]);
        Package::create([
            'price' => 29900,
            'amount' => 100000,
            'package_type_id' => PackageType::COIN_TYPE_ID,
        ]);
    }
}
