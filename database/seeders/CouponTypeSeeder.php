<?php

namespace Database\Seeders;

use App\Models\CouponType;
use Illuminate\Database\Seeder;

class CouponTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CouponType::create([
            'type' => 'fixed',
        ]);

        CouponType::create([
            'type' => 'percent',
        ]);
    }
}
