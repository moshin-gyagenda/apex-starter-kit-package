<?php

namespace ApexGlobal\ApexStarterKit\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apex:install
                            {--safe : Skip files that already exist (preserve customisations)}
                            {--config-only : Only publish config files}
                            {--views-only : Only publish view files}
                            {--assets-only : Only publish asset files}
                            {--stubs-only : Only publish stub files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Apex Starter Kit components into your application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Installing Apex Starter Kit...');
        $this->newLine();

        // Force is the default — use --safe to preserve existing files
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

        // Publish views
        if (!$configOnly && !$assetsOnly && !$stubsOnly) {
            $this->info('📦 Publishing view files...');
            $this->call('vendor:publish', [
                '--tag' => 'apex-views',
                '--force' => $force,
            ]);
            $this->call('vendor:publish', [
                '--tag' => 'apex-welcome',
                '--force' => $force,
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

        // Publish stubs (Fortify Actions, Service Providers, Controllers, Models, Routes)
        if (!$configOnly && !$viewsOnly && !$assetsOnly) {
            $this->info('📦 Publishing Fortify Actions, Service Providers, Controllers, Models, and Routes...');
            $this->call('vendor:publish', [
                '--tag' => 'apex-stubs',
                '--force' => $force,
            ]);
            $this->newLine();
        }

        // Update .env APP_NAME to Apex Starter Kit
        if (!$configOnly && !$viewsOnly && !$assetsOnly && !$stubsOnly) {
            $this->updateEnvAppName();
        }

        $this->info('✅ Apex Starter Kit installed successfully!');
        $this->newLine();

        $this->info('📝 Next steps:');
        $this->line('   1. Publish Spatie Permission migrations (if not done):');
        $this->line('      php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"');
        $this->line('');
        $this->line('   2. Run migrations:');
        $this->line('      php artisan migrate');
        $this->line('');
        $this->line('   3. Configure theme color (optional):');
        $this->line('      Edit config/theme.php to change the primary color');
        $this->line('');
        $this->line('   4. Start development server:');
        $this->line('      php artisan serve');
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

        // Replace APP_NAME (handles APP_NAME=Laravel, APP_NAME="Laravel", APP_NAME='Laravel')
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
