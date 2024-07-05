<?php

namespace Database\Seeders;

use App\Models\TransactionType;
use Illuminate\Database\Seeder;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransactionType::create([
            'type' => 'Subtraction',
        ]);

        TransactionType::create([
            'type' => 'Addition',
        ]);
    }
}
