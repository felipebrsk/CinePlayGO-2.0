<?php

namespace Database\Seeders;

use App\Models\MediaType;
use Illuminate\Database\Seeder;

class MediaTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MediaType::create([
            'type' => 'movie',
        ]);

        MediaType::create([
            'type' => 'tv',
        ]);
    }
}
