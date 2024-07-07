<?php

namespace Database\Seeders;

use App\Models\Title;
use Illuminate\Database\Seeder;

class TitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $storeFiveWatchlist = Title::create([
            'title' => 'Starting work',
            'price' => 6000,
        ]);

        $storeFiveWatchlist->requirements()->create([
            'task' => 'Store at least five movies on watchlist.',
            'goal' => 5,
            'title_id' => $storeFiveWatchlist->id,
        ]);

        $holdMyPic = Title::create([
            'title' => 'Hold my pic',
            'price' => null,
        ]);

        $holdMyPic->requirements()->create([
            'task' => 'Store a picture/avatar on platform.',
            'goal' => 1,
            'title_id' => $holdMyPic->id,
        ]);

        $ImNotARobot = Title::create([
            'title' => "I'm not a robot!",
            'price' => 20000,
        ]);

        $ImNotARobot->requirements()->create([
            'task' => 'Put at least 25 movies on watchlist.',
            'goal' => 25,
            'title_id' => $ImNotARobot->id,
        ]);

        $ImNotARobot->requirements()->create([
            'task' => 'Mark at least 10 movies as watched on your watchlist.',
            'goal' => 10,
            'title_id' => $ImNotARobot->id,
        ]);

        $ImAPirate = Title::create([
            'title' => "I'm a pirate",
            'price' => 100000,
        ]);

        $ImAPirate->requirements()->create([
            'task' => 'Make one transaction on platform.',
            'goal' => 1,
            'title_id' => $ImAPirate->id,
        ]);
    }
}
