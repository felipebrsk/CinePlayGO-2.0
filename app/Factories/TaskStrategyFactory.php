<?php

namespace App\Factories;

use App\Models\TitleRequirement;
use App\Strategies\{
    TaskStrategy,
    WatchedMoviesStrategy,
    WatchlistCountStrategy,
    AvatarUploadedStrategy,
    TransactionCountStrategy,
};

class TaskStrategyFactory
{
    /**
     * Make the strategy factory for title tasks.
     *
     * @param \App\Models\TitleRequirement $requirement
     * @return \App\Strategies\TaskStrategy
     */
    public static function make(TitleRequirement $requirement): TaskStrategy
    {
        switch ($requirement->task) {
            case 'Store at least five movies on watchlist.':
            case 'Put at least 25 movies on watchlist.':
                return new WatchlistCountStrategy();
            case 'Store a picture/avatar on platform.':
                return new AvatarUploadedStrategy();
            case 'Mark at least 10 movies as watched on your watchlist.':
                return new WatchedMoviesStrategy();
            case 'Make one transaction on platform.':
                return new TransactionCountStrategy();
            default:
                throw new \Exception("No strategy found for task: {$requirement->task}");
        }
    }
}
