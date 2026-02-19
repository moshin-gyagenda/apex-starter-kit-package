<?php

namespace ApexGlobal\ApexStarterKit;

use Illuminate\Support\ServiceProvider;
use ApexGlobal\ApexStarterKit\Commands\InstallCommand;

class ApexStarterKitServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Merge config
        $this->mergeConfigFrom(
            __DIR__.'/../config/theme.php', 'theme'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Publish config
        $this->publishes([
            __DIR__.'/../config/theme.php' => config_path('theme.php'),
            __DIR__.'/../config/permission.php' => config_path('permission.php'),
        ], 'apex-config');

        // Publish frontend views
        $this->publishes([
            __DIR__.'/../resources/views/frontend' => resource_path('views/frontend'),
        ], 'apex-views-frontend');

        // Publish backend views
        $this->publishes([
            __DIR__.'/../resources/views/backend' => resource_path('views/backend'),
        ], 'apex-views-backend');

        // Publish auth views
        $this->publishes([
            __DIR__.'/../resources/views/auth' => resource_path('views/auth'),
        ], 'apex-views-auth');

        // Publish profile views
        $this->publishes([
            __DIR__.'/../resources/views/profile' => resource_path('views/profile'),
        ], 'apex-views-profile');

        // Publish components
        $this->publishes([
            __DIR__.'/../resources/views/components' => resource_path('views/components'),
        ], 'apex-components');

        // Publish all views at once (including components)
        $this->publishes([
            __DIR__.'/../resources/views/frontend' => resource_path('views/frontend'),
            __DIR__.'/../resources/views/backend' => resource_path('views/backend'),
            __DIR__.'/../resources/views/auth' => resource_path('views/auth'),
            __DIR__.'/../resources/views/profile' => resource_path('views/profile'),
            __DIR__.'/../resources/views/components' => resource_path('views/components'),
        ], 'apex-views');

        // Replace default welcome page
        $this->publishes([
            __DIR__.'/../stubs/resources/views/welcome.blade.php' => resource_path('views/welcome.blade.php'),
        ], 'apex-welcome');

        // Publish assets
        $this->publishes([
            __DIR__.'/../resources/assets' => public_path('assets'),
        ], 'apex-assets');

        // Publish Fortify Actions
        $this->publishes([
            __DIR__.'/../stubs/app/Actions/Fortify/CreateNewUser.php' => app_path('Actions/Fortify/CreateNewUser.php'),
            __DIR__.'/../stubs/app/Actions/Fortify/UpdateUserProfileInformation.php' => app_path('Actions/Fortify/UpdateUserProfileInformation.php'),
            __DIR__.'/../stubs/app/Actions/Fortify/UpdateUserPassword.php' => app_path('Actions/Fortify/UpdateUserPassword.php'),
            __DIR__.'/../stubs/app/Actions/Fortify/ResetUserPassword.php' => app_path('Actions/Fortify/ResetUserPassword.php'),
            __DIR__.'/../stubs/app/Actions/Fortify/PasswordValidationRules.php' => app_path('Actions/Fortify/PasswordValidationRules.php'),
        ], 'apex-fortify-actions');

        // Publish Jetstream Actions
        $this->publishes([
            __DIR__.'/../stubs/app/Actions/Jetstream/DeleteUser.php' => app_path('Actions/Jetstream/DeleteUser.php'),
        ], 'apex-jetstream-actions');

        // Publish Service Providers
        $this->publishes([
            __DIR__.'/../stubs/app/Providers/FortifyServiceProvider.php' => app_path('Providers/FortifyServiceProvider.php'),
            __DIR__.'/../stubs/app/Providers/JetstreamServiceProvider.php' => app_path('Providers/JetstreamServiceProvider.php'),
        ], 'apex-providers');

        // Publish Controllers
        $this->publishes([
            __DIR__.'/../stubs/app/Http/Controllers/UserController.php' => app_path('Http/Controllers/UserController.php'),
            __DIR__.'/../stubs/app/Http/Controllers/DashboardController.php' => app_path('Http/Controllers/DashboardController.php'),
            __DIR__.'/../stubs/app/Http/Controllers/FrontendController.php' => app_path('Http/Controllers/FrontendController.php'),
            __DIR__.'/../stubs/app/Http/Controllers/SecurityController.php' => app_path('Http/Controllers/SecurityController.php'),
            __DIR__.'/../stubs/app/Http/Controllers/RoleController.php' => app_path('Http/Controllers/RoleController.php'),
            __DIR__.'/../stubs/app/Http/Controllers/PermissionController.php' => app_path('Http/Controllers/PermissionController.php'),
        ], 'apex-controllers');

        // Publish Models
        $this->publishes([
            __DIR__.'/../stubs/app/Models/User.php' => app_path('Models/User.php'),
            __DIR__.'/../stubs/app/Models/SecurityLog.php' => app_path('Models/SecurityLog.php'),
        ], 'apex-models');

        // Publish Seeders
        $this->publishes([
            __DIR__.'/../stubs/database/seeders/DatabaseSeeder.php' => database_path('seeders/DatabaseSeeder.php'),
            __DIR__.'/../stubs/database/seeders/UserSeeder.php' => database_path('seeders/UserSeeder.php'),
            __DIR__.'/../stubs/database/seeders/RolePermissionSeeder.php' => database_path('seeders/RolePermissionSeeder.php'),
        ], 'apex-seeders');

        // Publish Routes
        $this->publishes([
            __DIR__.'/../stubs/routes/web.php' => base_path('routes/web.php'),
        ], 'apex-routes');

        // Publish Bootstrap Providers
        $this->publishes([
            __DIR__.'/../stubs/bootstrap/providers.php' => base_path('bootstrap/providers.php'),
        ], 'apex-bootstrap');

        // Publish all stubs at once
        $this->publishes([
            // Fortify Actions
            __DIR__.'/../stubs/app/Actions/Fortify/CreateNewUser.php' => app_path('Actions/Fortify/CreateNewUser.php'),
            __DIR__.'/../stubs/app/Actions/Fortify/UpdateUserProfileInformation.php' => app_path('Actions/Fortify/UpdateUserProfileInformation.php'),
            __DIR__.'/../stubs/app/Actions/Fortify/UpdateUserPassword.php' => app_path('Actions/Fortify/UpdateUserPassword.php'),
            __DIR__.'/../stubs/app/Actions/Fortify/ResetUserPassword.php' => app_path('Actions/Fortify/ResetUserPassword.php'),
            __DIR__.'/../stubs/app/Actions/Fortify/PasswordValidationRules.php' => app_path('Actions/Fortify/PasswordValidationRules.php'),
            // Jetstream Actions
            __DIR__.'/../stubs/app/Actions/Jetstream/DeleteUser.php' => app_path('Actions/Jetstream/DeleteUser.php'),
            // Service Providers
            __DIR__.'/../stubs/app/Providers/FortifyServiceProvider.php' => app_path('Providers/FortifyServiceProvider.php'),
            __DIR__.'/../stubs/app/Providers/JetstreamServiceProvider.php' => app_path('Providers/JetstreamServiceProvider.php'),
            // Controllers
            __DIR__.'/../stubs/app/Http/Controllers/UserController.php' => app_path('Http/Controllers/UserController.php'),
            __DIR__.'/../stubs/app/Http/Controllers/DashboardController.php' => app_path('Http/Controllers/DashboardController.php'),
            __DIR__.'/../stubs/app/Http/Controllers/FrontendController.php' => app_path('Http/Controllers/FrontendController.php'),
            __DIR__.'/../stubs/app/Http/Controllers/SecurityController.php' => app_path('Http/Controllers/SecurityController.php'),
            __DIR__.'/../stubs/app/Http/Controllers/RoleController.php' => app_path('Http/Controllers/RoleController.php'),
            __DIR__.'/../stubs/app/Http/Controllers/PermissionController.php' => app_path('Http/Controllers/PermissionController.php'),
            // Models
            __DIR__.'/../stubs/app/Models/User.php' => app_path('Models/User.php'),
            __DIR__.'/../stubs/app/Models/SecurityLog.php' => app_path('Models/SecurityLog.php'),
            // Routes
            __DIR__.'/../stubs/routes/web.php' => base_path('routes/web.php'),
            // Bootstrap
            __DIR__.'/../stubs/bootstrap/providers.php' => base_path('bootstrap/providers.php'),
            // Seeders
            __DIR__.'/../stubs/database/seeders/DatabaseSeeder.php' => database_path('seeders/DatabaseSeeder.php'),
            __DIR__.'/../stubs/database/seeders/UserSeeder.php' => database_path('seeders/UserSeeder.php'),
            __DIR__.'/../stubs/database/seeders/RolePermissionSeeder.php' => database_path('seeders/RolePermissionSeeder.php'),
            // Replace welcome page
            __DIR__.'/../stubs/resources/views/welcome.blade.php' => resource_path('views/welcome.blade.php'),
        ], 'apex-stubs');

        // Publish migrations
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }

        // Register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }
    }
}
