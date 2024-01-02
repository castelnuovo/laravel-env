<?php

namespace Castelnuovo\LaravelEnv\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\error;
use function Laravel\Prompts\info;
use function Laravel\Prompts\note;
use function Laravel\Prompts\password;
use function Laravel\Prompts\warning;

class LaravelEnvCommand extends Command implements PromptsForMissingInput
{
    protected $signature = 'env:edit
        {env : The environment to edit .env file for}
        {--c|code : Open the decrypted .env file in VS Code}';

    protected $description = 'Decrypt, Edit and Encrypt .env files';

    protected function promptForMissingArgumentsUsing()
    {
        return [
            'env' => [
                'Which environment do you want to edit the .env file for?',
                'E.g. production',
            ],
        ];
    }

    public function handle(): int
    {
        $disk = Storage::build(['driver' => 'local', 'root' => base_path()]);
        $env = $this->argument('env');

        $encryptedEnv = ".env.{$env}.encrypted";
        $decryptedEnv = ".env.{$env}";

        $key = password("What is the decryption key for {$encryptedEnv}?", required: true);

        if (! $this->decryptEnv($env, $key)) {
            error("{$encryptedEnv} could not be decrypted");

            return self::FAILURE;
        }

        info("Please open, edit and save {$decryptedEnv}.");
        note($disk->path($decryptedEnv));

        if ($this->option('code')) {
            Process::quietly()->run("code {$disk->path($decryptedEnv)}");
        }

        if (confirm("Store changes made to {$decryptedEnv}?")) {
            if (! $this->encryptEnv($env, $key)) {
                error("{$decryptedEnv} could not be encrypted");

                return self::FAILURE;
            }

            info('Changes were saved and encrypted!');
        } else {
            warning('Changes were discarded!');
        }

        $disk->delete($decryptedEnv);

        return self::SUCCESS;
    }

    protected function decryptEnv(string $env, string $key): bool
    {
        return $this->call('env:decrypt', [
            '--key' => $key,
            '--env' => $env,
            '--force' => true,
            '--quiet' => true,
        ]) === self::SUCCESS;
    }

    protected function encryptEnv(string $env, string $key): bool
    {
        return $this->call('env:encrypt', [
            '--key' => $key,
            '--env' => $env,
            '--force' => true,
            '--quiet' => true,
        ]) === self::SUCCESS;
    }
}
