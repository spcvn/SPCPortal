<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    protected $seed = true;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://SPCVN.dev';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    protected function refreshAppAndExecuteCallbacks()
    {
        $oldSeed = $this->seed;
        $this->seed = $this->isSQLiteConnection();

        $this->refreshApplication();
        $this->executeCallbacks();

        $this->seed = $oldSeed;
    }

    protected function executeCallbacks()
    {
        foreach ($this->afterApplicationCreatedCallbacks as $callback) {
            call_user_func($callback);
        }
    }

    protected function isSQLiteConnection()
    {
        return \DB::connection() instanceof \Illuminate\Database\SQLiteConnection;
    }
}

