<?php

namespace Castelnuovo\LaravelEnv\Commands;

use Illuminate\Console\Command;

class LaravelEnvCommand extends Command
{
    public $signature = 'laravel-env';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
