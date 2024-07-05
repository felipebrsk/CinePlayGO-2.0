<?php

namespace Tests;

use Tests\Traits\HasDummyUser;
use Illuminate\Support\Collection;
use Laravel\Dusk\TestCase as BaseTestCase;
use Facebook\WebDriver\Chrome\ChromeOptions;
use PHPUnit\Framework\Attributes\BeforeClass;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Facebook\WebDriver\Remote\{RemoteWebDriver, DesiredCapabilities};

abstract class DuskTestCase extends BaseTestCase
{
    use HasDummyUser;
    use DatabaseMigrations;

    /**
     * The dummy user.
     *
     * @var \App\Models\User
     */
    protected $user;

    /**
     * Setup new test environments.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createDummyUser();
    }

    /**
     * Prepare for Dusk test execution.
     */
    #[BeforeClass]
    public static function prepare(): void
    {
        if (!static::runningInSail()) {
            static::startChromeDriver();
        }
    }

    /**
     * Create the RemoteWebDriver instance.
     */
    protected function driver(): RemoteWebDriver
    {
        $options = (new ChromeOptions())->addArguments(collect([
            $this->shouldStartMaximized() ? '--start-maximized' : '--window-size=1920,1080',
        ])->unless($this->hasHeadlessDisabled(), function (Collection $items) {
            return $items->merge([
                '--disable-gpu',
                '--headless=new',
            ]);
        })->all());

        return RemoteWebDriver::create(
            'http://localhost:9515',
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY,
                $options
            )
        );
    }
}
