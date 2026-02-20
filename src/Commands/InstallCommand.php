<?php

namespace ApexGlobal\ApexStarterKit\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'apex:install
                            {--safe : Skip files that already exist (preserve customisations)}
                            {--config-only : Only publish config files}
                            {--views-only : Only publish view files}
                            {--assets-only : Only publish asset files}
                            {--stubs-only : Only publish stub files}';

    protected $description = 'Install Apex Starter Kit components into your application';

    /**
     * Providers that must be present in bootstrap/providers.php.
     */
    protected array $requiredProviders = [
        'App\Providers\FortifyServiceProvider::class',
        'App\Providers\JetstreamServiceProvider::class',
    ];

    public function handle()
    {
        $this->info('🚀 Installing Apex Starter Kit...');
        $this->newLine();

        $force = !$this->option('safe');
        $configOnly = $this->option('config-only');
        $viewsOnly = $this->option('views-only');
        $assetsOnly = $this->option('assets-only');
        $stubsOnly = $this->option('stubs-only');

        if (!$force) {
            $this->warn('Running in safe mode — existing files will be skipped.');
            $this->newLine();
        }

        // Publish config
        if (!$viewsOnly && !$assetsOnly && !$stubsOnly) {
            $this->info('📦 Publishing configuration files...');
            $this->call('vendor:publish', [
                '--tag' => 'apex-config',
                '--force' => $force,
            ]);
            $this->newLine();
        }

        // Publish views + always overwrite welcome.blade.php
        if (!$configOnly && !$assetsOnly && !$stubsOnly) {
            $this->info('📦 Publishing view files...');
            $this->call('vendor:publish', [
                '--tag' => 'apex-views',
                '--force' => $force,
            ]);
            $this->call('vendor:publish', [
                '--tag' => 'apex-welcome',
                '--force' => true,
            ]);
            $this->newLine();
        }

        // Publish assets
        if (!$configOnly && !$viewsOnly && !$stubsOnly) {
            $this->info('📦 Publishing assets...');
            $this->call('vendor:publish', [
                '--tag' => 'apex-assets',
                '--force' => $force,
            ]);
            $this->newLine();
        }

        // Publish stubs (Actions, Controllers, Models, Routes, Seeders, Service Providers)
        if (!$configOnly && !$viewsOnly && !$assetsOnly) {
            $this->info('📦 Publishing controllers, models, routes, and service providers...');
            $this->call('vendor:publish', [
                '--tag' => 'apex-stubs',
                '--force' => $force,
            ]);
            $this->newLine();
        }

        // Auto-register providers in bootstrap/providers.php
        if (!$configOnly && !$viewsOnly && !$assetsOnly) {
            $this->registerProviders();
        }

        // Publish Spatie Permission migrations automatically
        if (!$configOnly && !$viewsOnly && !$assetsOnly && !$stubsOnly) {
            $this->info('📦 Publishing Spatie Permission migrations...');
            $this->call('vendor:publish', [
                '--provider' => 'Spatie\Permission\PermissionServiceProvider',
            ]);
            $this->newLine();
        }

        // Update .env APP_NAME
        if (!$configOnly && !$viewsOnly && !$assetsOnly && !$stubsOnly) {
            $this->updateEnvAppName();
        }

        $this->newLine();
        $this->info('✅ Apex Starter Kit installed successfully!');
        $this->newLine();

        $this->info('📝 Next steps:');
        $this->line('   1. Run migrations:');
        $this->line('      php artisan migrate');
        $this->line('');
        $this->line('   2. (Optional) Seed demo data:');
        $this->line('      php artisan db:seed');
        $this->line('');
        $this->line('   3. Build frontend assets:');
        $this->line('      npm install && npm run build');
        $this->line('');
        $this->line('   4. Start development server:');
        $this->line('      php artisan serve');
        $this->line('');
        $this->line('   5. Configure theme color (optional):');
        $this->line('      Edit config/theme.php to change the primary color');
    }

    /**
     * Inject FortifyServiceProvider and JetstreamServiceProvider into
     * bootstrap/providers.php without overwriting the whole file.
     */
    protected function registerProviders(): void
    {
        $providersPath = base_path('bootstrap/providers.php');

        if (!file_exists($providersPath)) {
            $this->warn('  bootstrap/providers.php not found — skipping provider registration.');
            return;
        }

        $contents = file_get_contents($providersPath);
        $added = [];

        foreach ($this->requiredProviders as $provider) {
            if (!str_contains($contents, $provider)) {
                // Insert before the closing bracket of the return array
                $contents = preg_replace(
                    '/(\];)(\s*)$/',
                    "    {$provider},\n$1$2",
                    $contents
                );
                $added[] = $provider;
            }
        }

        if (!empty($added)) {
            file_put_contents($providersPath, $contents);
            $this->info('📋 Registered providers in bootstrap/providers.php:');
            foreach ($added as $provider) {
                $this->line("      + {$provider}");
            }
        } else {
            $this->info('📋 Providers already registered in bootstrap/providers.php');
        }

        $this->newLine();
    }

    /**
     * Update APP_NAME in .env to "Apex Starter Kit".
     */
    protected function updateEnvAppName(): void
    {
        $envPath = base_path('.env');

        if (!file_exists($envPath)) {
            return;
        }

        $contents = file_get_contents($envPath);

        $updated = preg_replace(
            '/^APP_NAME=(.*)$/m',
            'APP_NAME="Apex Starter Kit"',
            $contents,
            1,
            $count
        );

        if ($count > 0) {
            file_put_contents($envPath, $updated);
            $this->info('📝 Updated .env: APP_NAME="Apex Starter Kit"');
        }
    }
}
