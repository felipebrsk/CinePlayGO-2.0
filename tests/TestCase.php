<?php

namespace Tests;

use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Setup new test environemnts.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        Storage::fake(env('FILESYSTEM_DISK', 's3'));
    }
}
