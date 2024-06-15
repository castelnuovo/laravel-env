<?php

namespace Castelnuovo\LaravelEnv\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\error;
use function Laravel\Prompts\info;
use function Laravel\Prompts\password;
use function Laravel\Prompts\select;

class LaravelEnvCommand extends Command implements PromptsForMissingInput
{
    protected $signature = 'env:edit
        {env : The environment to edit .env file for}
        {key : The decryption key for the .env file}
        {--c|code : Open the decrypted .env file in VS Code}';

    protected $description = 'Decrypt, Edit and Encrypt .env files';

    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'env' => fn () => select(
                label: 'Which encrypted env do you want to edit?',
                options: $this->envs()->toArray(),
                required: true,
            ),
            'key' => fn () => password(
                label: 'What is the decryption key for the encrypted env?',
                required: true,
            ),
        ];
    }

    public function handle(): int
    {
        $encEnvFile = ".env.{$this->argument('env')}.encrypted";

        if (! $this->envs()->contains($this->argument('env'))) {
            error("{$encEnvFile} does not exist!");

            return self::FAILURE;
        }

        if (! $this->decrypt()) {
            return self::FAILURE;
        }

        $envFile = ".env.{$this->argument('env')}";
        $envFilePath = base_path($envFile);

        info("Open, edit and save: {$envFilePath}");

        if ($this->option('code')) {
            Process::quietly()->run("code {$envFilePath}");
        }

        if (confirm("Store changes made to {$envFile}?")) {
            if (! $this->encrypt()) {
                return self::FAILURE;
            }
        }

        return self::SUCCESS;
    }

    /**
     * Get the disk for the encrypted .env files.
     */
    protected function disk(): Filesystem
    {
        return Storage::build(['driver' => 'local', 'root' => base_path()]);
    }

    /**
     * Get environments of the encrypted .env files.
     */
    protected function envs(): Collection
    {
        return collect($this->disk()->files())
            ->filter(fn ($file) => preg_match('/\.env\..*\.encrypted/', $file))
            ->map(fn ($file) => preg_replace('/\.env\.(.*)\.encrypted/', '$1', $file))
            ->flatten();
    }

    /**
     * Decrypt the .env file for the given environment.
     */
    protected function decrypt(): bool
    {
        $result = $this->call('env:decrypt', [
            '--env' => $this->argument('env'),
            '--key' => $this->argument('key'),
            '--force' => true,
            '--quiet' => true,
        ]);

        return $result === Command::SUCCESS;
    }

    /**
     * Encrypt the .env file for the given environment.
     */
    protected function encrypt(): bool
    {
        $result = $this->call('env:encrypt', [
            '--env' => $this->argument('env'),
            '--key' => $this->argument('key'),
            '--prune' => true,
            '--force' => true,
            '--quiet' => true,
        ]);

        return $result === Command::SUCCESS;
    }
}
