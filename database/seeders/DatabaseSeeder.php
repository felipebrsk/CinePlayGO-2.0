<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            TitleSeeder::class,
            MediaTypeSeeder::class,
            TransactionTypeSeeder::class,
            PackageSeeder::class,
            CouponTypeSeeder::class,
        ]);
    }
}
