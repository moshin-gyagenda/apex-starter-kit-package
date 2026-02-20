# Apex Starter Kit — Architecture & Developer Guide

A complete reference for anyone who wants to understand, maintain, or extend this package. No prior knowledge of Laravel packages is assumed.

---

## Table of Contents

1. [What is a Laravel Package?](#1-what-is-a-laravel-package)
2. [What is a Starter Kit?](#2-what-is-a-starter-kit)
3. [How This Package Works — The Big Picture](#3-how-this-package-works--the-big-picture)
4. [How a Laravel App Boots](#4-how-a-laravel-app-boots)
5. [Package Root Files](#5-package-root-files)
6. [The `src/` Folder — The Package Engine](#6-the-src-folder--the-package-engine)
7. [The `config/` Folder — Default Configuration](#7-the-config-folder--default-configuration)
8. [The `database/` Folder — Migrations](#8-the-database-folder--migrations)
9. [The `resources/` Folder — Views](#9-the-resources-folder--views)
10. [The `stubs/` Folder — Code Published Into the App](#10-the-stubs-folder--code-published-into-the-app)
11. [The `.github/` Folder — CI/CD](#11-the-github-folder--cicd)
12. [How `apex:install` Works Step by Step](#12-how-apexinstall-works-step-by-step)
13. [Data Flow — From Request to Response](#13-data-flow--from-request-to-response)
14. [The Role & Permission System](#14-the-role--permission-system)
15. [The Security Log System](#15-the-security-log-system)
16. [How to Make Changes and Release](#16-how-to-make-changes-and-release)
17. [Glossary](#17-glossary)

---

## 1. What is a Laravel Package?

A **Laravel package** is a reusable piece of code that you install into a Laravel application using Composer. It is not an app itself — it is a plugin that adds functionality to an existing app.

### How Composer works

Composer is PHP's dependency manager. When you run:

```bash
composer require apexglobal/apex-starter-kit
```

Composer:
1. Reads `composer.json` in this package to learn what the package is and what it depends on
2. Downloads the package into the app's `vendor/apexglobal/apex-starter-kit/` folder
3. Generates an autoloader so PHP can find all the classes without manual `require` statements

### How Laravel discovers the package

Laravel reads `composer.json`'s `extra.laravel.providers` array:

```json
"extra": {
    "laravel": {
        "providers": [
            "ApexGlobal\\ApexStarterKit\\ApexStarterKitServiceProvider"
        ]
    }
}
```

On every `composer install` or `composer update`, Laravel runs `php artisan package:discover`, which reads this from every installed package and writes a cached list to `bootstrap/cache/packages.php`. This is how Laravel knows to automatically load our `ApexStarterKitServiceProvider` without the developer doing anything extra.

---

## 2. What is a Starter Kit?

A **starter kit** is a special kind of package whose main job is to **publish code into the app** — not to run code inside the vendor folder permanently.

### Regular package vs Starter Kit

| Regular Package | Starter Kit |
|----------------|-------------|
| Code stays in `vendor/` | Code is copied into `app/`, `resources/`, etc. |
| App calls the package's classes | App owns the published code directly |
| Updated via `composer update` | Updates require re-publishing stubs |
| Example: `spatie/laravel-permission` | Example: `apexglobal/apex-starter-kit` |

The key insight: **once installed, the developer owns the code**. They can edit controllers, views, and models freely. The package in `vendor/` is just the source that was copied.

### Why publish instead of keeping in vendor?

If views and controllers stayed in `vendor/`, the developer could not customise them without modifying vendor files (which get overwritten on `composer update`). By publishing into `app/` and `resources/`, the developer gets full ownership.

---

## 3. How This Package Works — The Big Picture

```
┌─────────────────────────────────────────────────────────────┐
│                    PACKAGIST / GITHUB                        │
│              apexglobal/apex-starter-kit                     │
└────────────────────────┬────────────────────────────────────┘
                         │  composer require
                         ▼
┌─────────────────────────────────────────────────────────────┐
│              vendor/apexglobal/apex-starter-kit/             │
│                                                              │
│  src/                  ← Package engine (always in vendor)   │
│  config/               ← Default configs (publishable)       │
│  database/migrations/  ← DB schema (auto-loaded)             │
│  resources/views/      ← UI views (publishable)              │
│  stubs/                ← Code templates (publishable)        │
└────────────────────────┬────────────────────────────────────┘
                         │  php artisan apex:install
                         ▼
┌─────────────────────────────────────────────────────────────┐
│                    YOUR LARAVEL APP                          │
│                                                              │
│  config/theme.php              ← from config/               │
│  config/permission.php         ← from config/               │
│  config/fortify.php            ← from stubs/config/         │
│  app/Http/Controllers/         ← from stubs/app/...         │
│  app/Models/                   ← from stubs/app/Models/     │
│  app/Providers/                ← from stubs/app/Providers/  │
│  app/Actions/                  ← from stubs/app/Actions/    │
│  resources/views/              ← from resources/views/      │
│  public/assets/                ← from resources/assets/     │
│  routes/web.php                ← from stubs/routes/         │
│  database/seeders/             ← from stubs/database/       │
│  bootstrap/providers.php       ← auto-injected by command   │
└─────────────────────────────────────────────────────────────┘
```

---

## 4. How a Laravel App Boots

Understanding the boot sequence helps you understand where every part of this package plugs in.

```
1. public/index.php          ← Entry point for every HTTP request
2. bootstrap/app.php         ← Creates the Laravel Application instance
3. bootstrap/providers.php   ← Lists which ServiceProviders to load
4. ServiceProviders boot()   ← FortifyServiceProvider, JetstreamServiceProvider
5. Routes registered         ← routes/web.php is loaded
6. Middleware runs            ← auth, throttle, verified, etc.
7. Controller called          ← e.g. DashboardController::index()
8. View rendered              ← Blade template compiled and returned
9. Response sent to browser
```

Our `apex:install` command touches steps 3, 4, 5, 7, and 8 by publishing the right files.

---

## 5. Package Root Files

```
apex-starter-kit-package/
├── composer.json       ← Package identity, dependencies, autoloading
├── README.md           ← Public-facing documentation (shown on Packagist/GitHub)
├── ARCHITECTURE.md     ← This file
├── CHANGELOG.md        ← Version history
├── INSTALLATION.md     ← Step-by-step install guide
├── DEVELOPING.md       ← Guide for package contributors
├── PUBLISHING.md       ← Guide for releasing to Packagist
├── LICENSE             ← MIT license text
└── .gitignore          ← Files excluded from git (vendor/, PUBLISHING.md, etc.)
```

### `composer.json` in depth

```json
{
    "name": "apexglobal/apex-starter-kit",
    "type": "library",
    "require": { ... },          // What must be installed for this package to work
    "require-dev": { ... },      // Only needed when developing the package itself
    "autoload": {
        "psr-4": {
            "ApexGlobal\\ApexStarterKit\\": "src/"
        }
    },
    "extra": {
        "laravel": {
            "providers": ["ApexGlobal\\ApexStarterKit\\ApexStarterKitServiceProvider"]
        }
    }
}
```

**PSR-4 autoloading** means: any class in the `src/` folder whose namespace starts with `ApexGlobal\ApexStarterKit\` will be found automatically by PHP. For example, `src/Commands/InstallCommand.php` has namespace `ApexGlobal\ApexStarterKit\Commands` and class `InstallCommand` — PHP finds it at `src/Commands/InstallCommand.php`.

---

## 6. The `src/` Folder — The Package Engine

This is the only code that **permanently lives in vendor** and runs on every request. Keep it minimal.

```
src/
├── ApexStarterKitServiceProvider.php   ← The package's entry point
└── Commands/
    └── InstallCommand.php              ← The apex:install command
```

### `ApexStarterKitServiceProvider.php`

A **Service Provider** is Laravel's way of bootstrapping any piece of functionality. Every package has one. Laravel calls two methods automatically:

**`register()`** — runs before the app fully boots. Use it to bind things into the service container. We use it to merge the default theme config so `config('theme')` always works even before publishing:

```php
public function register(): void
{
    $this->mergeConfigFrom(__DIR__.'/../config/theme.php', 'theme');
}
```

**`boot()`** — runs after the app is fully booted. Use it to register publishable assets, load migrations, and register commands:

```php
public function boot(): void
{
    // Tell Laravel what files can be published and under what tag
    $this->publishes([...], 'apex-config');
    $this->publishes([...], 'apex-views');
    $this->publishes([...], 'apex-stubs');

    // Auto-load our migrations so they run with php artisan migrate
    $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

    // Register apex:install as an artisan command
    $this->commands([InstallCommand::class]);
}
```

The **publish tags** are groups. When `vendor:publish --tag=apex-views` is called, only the views are published. The `apex:install` command calls each tag in sequence.

### `Commands/InstallCommand.php`

This is the `php artisan apex:install` command. It:

1. Calls `vendor:publish` for each tag in order (config → views → assets → stubs)
2. Directly reads and modifies `bootstrap/providers.php` to inject `FortifyServiceProvider` and `JetstreamServiceProvider` if they are not already there — without overwriting the whole file
3. Updates `APP_NAME` in `.env`
4. Prints the next steps to the terminal

The `--safe` flag reverses the default force behaviour so existing files are skipped — useful when re-running after customisation.

---

## 7. The `config/` Folder — Default Configuration

```
config/
├── theme.php       ← Controls the primary UI colour
└── permission.php  ← Spatie Permission configuration
```

### `config/theme.php`

```php
return [
    'primary' => '#6366f1',  // indigo — used across all Blade views
];
```

Views reference it as `config('theme.primary')`. Changing this one value updates every button, link, and accent colour across the entire UI.

The ServiceProvider uses `mergeConfigFrom()` so this default is always available. When the developer publishes it to their `config/theme.php`, their value takes precedence.

### `config/permission.php`

Spatie Laravel Permission configuration — controls table names, cache settings, and which guard is used for role/permission checks. Published to the app so developers can customise it.

---

## 8. The `database/` Folder — Migrations

```
database/
└── migrations/
    ├── 2025_02_19_000000_add_login_fields_to_users_table.php
    └── 2025_11_18_201123_create_security_logs_table.php
```

These migrations are **auto-loaded** by the ServiceProvider using `loadMigrationsFrom()`. This means they run automatically with `php artisan migrate` without the developer needing to publish them. This is intentional — migrations should not be edited by the developer.

### `add_login_fields_to_users_table`

Adds columns to the standard Laravel `users` table:
- `last_login_at` — timestamp of the most recent login
- `last_login_location` — string description of location (e.g. "Kampala, Uganda")
- `last_login_latitude` / `last_login_longitude` — GPS coordinates for future map features

### `create_security_logs_table`

Creates the `security_logs` table with columns:
- `user_id` — which user triggered the event (nullable for guest attempts)
- `event` — type of event (e.g. `login`, `logout`, `failed_login`)
- `ip_address` — the IP that made the request
- `user_agent` — browser/device string
- `location`, `latitude`, `longitude` — where the request came from
- `metadata` — JSON column for any extra context
- `created_at` / `updated_at` — standard timestamps

---

## 9. The `resources/` Folder — Views

These are the Blade templates that define the entire UI. They are published into the app's `resources/views/` folder so developers can edit them.

```
resources/views/
├── auth/           ← Login, register, password reset, 2FA, email verify
├── backend/        ← The admin panel
│   ├── dashboard/  ← Dashboard with stats and charts
│   ├── exports/    ← PDF templates for CSV/PDF exports
│   ├── layouts/    ← The main admin HTML shell (nav, sidebar, footer)
│   ├── partials/   ← Reusable pieces (header, sidebar, footer, modals, pagination)
│   ├── permissions/← Permissions index page
│   ├── roles/      ← Roles index page
│   ├── security/   ← Security logs index and detail
│   └── users/      ← Users CRUD (index, create, edit, show)
├── components/     ← Jetstream UI components (buttons, modals, inputs, etc.)
├── frontend/       ← The public-facing landing page
│   ├── layouts/    ← Frontend HTML shell
│   ├── partials/   ← Frontend header and footer
│   └── index.blade.php ← The landing page content
└── profile/        ← User profile management pages
```

### How Blade views work

Blade is Laravel's templating engine. Files end in `.blade.php`. Key concepts:

- `@extends('backend.layouts.app')` — this view inherits from the layout
- `@section('content') ... @endsection` — fills a slot defined in the layout
- `@include('backend.partials.sidebar')` — embeds another view inline
- `{{ $variable }}` — outputs a variable safely (HTML-escaped)
- `{!! $html !!}` — outputs raw HTML (use carefully)
- `@if / @foreach / @auth` — control structures

### `backend/layouts/app.blade.php`

The master HTML shell for all admin pages. It includes:
- The HTML `<head>` with Tailwind CSS, custom assets, and meta tags
- The sidebar navigation
- The top header bar
- A `@yield('content')` slot where each page inserts its content
- The footer
- JavaScript includes (Tom Select for searchable dropdowns, chart libraries, etc.)

### `backend/partials/`

| File | Purpose |
|------|---------|
| `header.blade.php` | Top bar with user menu, notifications |
| `sidebar.blade.php` | Left navigation with links to all admin sections |
| `footer.blade.php` | Bottom bar |
| `pagination.blade.php` | Custom pagination links used on all tables |
| `confirm-action-modal.blade.php` | Generic confirmation modal (e.g. block IP) |
| `confirm-bulk-delete-modal.blade.php` | Confirmation modal for bulk delete |

### `backend/exports/`

These are Blade views used by `barryvdh/laravel-dompdf` to generate PDF files. Each one receives a collection of data and outputs an HTML table that DomPDF converts to a downloadable PDF.

---

## 10. The `stubs/` Folder — Code Published Into the App

Stubs are **template files** that get copied verbatim into the developer's app when `apex:install` runs. Once copied, the developer owns them entirely.

```
stubs/
├── app/
│   ├── Actions/
│   │   ├── Fortify/        ← How users are created, passwords updated, etc.
│   │   └── Jetstream/      ← How users are deleted
│   ├── Http/Controllers/   ← All the admin controllers
│   ├── Models/             ← User and SecurityLog models
│   └── Providers/          ← FortifyServiceProvider, JetstreamServiceProvider
├── bootstrap/
│   └── providers.php       ← Kept as reference; injected programmatically
├── config/
│   └── fortify.php         ← Fortify configuration (sets home to /dashboard)
├── database/
│   └── seeders/            ← Demo data seeders
├── resources/views/
│   └── welcome.blade.php   ← Replaces Laravel's default welcome page
└── routes/
    └── web.php             ← All application routes
```

### `stubs/app/Actions/Fortify/`

Fortify is Laravel's headless authentication library. It defines **what happens** during auth events but lets you customise the logic via Action classes.

| File | What it does |
|------|-------------|
| `CreateNewUser.php` | Runs when someone registers. Validates input, creates the User record, assigns the default `user` role |
| `UpdateUserProfileInformation.php` | Runs when a user saves their profile. Validates and updates name/email |
| `UpdateUserPassword.php` | Runs when a user changes their password. Validates current password and saves new one |
| `ResetUserPassword.php` | Runs during password reset flow. Sets the new password after reset link is clicked |
| `PasswordValidationRules.php` | A trait that defines the password rules (min 8 chars, etc.) used by the above actions |

### `stubs/app/Actions/Jetstream/DeleteUser.php`

Runs when a user deletes their own account from the profile page. Handles cleanup before the user record is removed.

### `stubs/app/Providers/FortifyServiceProvider.php`

Registers the Fortify action classes above, sets up rate limiters for the login and two-factor routes, and listens for the `Login` event to record the login timestamp and location on the user record.

### `stubs/app/Providers/JetstreamServiceProvider.php`

Configures Jetstream features — which profile management features are enabled (profile photo, two-factor auth, browser sessions, account deletion).

### `stubs/app/Models/`

**`User.php`** — The application's User model. Extends Laravel's default `Authenticatable`. Key traits added:
- `HasRoles` from Spatie — gives the user `->assignRole()`, `->hasRole()`, `->can()` methods
- `HasFactory` for seeding
- `TwoFactorAuthenticatable` from Jetstream

**`SecurityLog.php`** — Eloquent model for the `security_logs` table. Has a `belongsTo(User::class)` relationship. Used by `SecurityController` to display and filter logs.

### `stubs/app/Http/Controllers/`

These are the controllers that handle every admin page. Each one is a standard Laravel controller.

| Controller | Routes it handles | Key methods |
|-----------|------------------|-------------|
| `FrontendController` | `GET /` | `index()` — returns the landing page |
| `DashboardController` | `GET /dashboard` | `index()` — fetches stats, chart data, recent logs |
| `UserController` | `GET/POST /admin/users/*` | Full CRUD + `exportCsv()`, `exportPdf()`, `bulkDestroy()` |
| `RoleController` | `GET/POST /admin/roles/*` | CRUD via modals + export + bulk delete |
| `PermissionController` | `GET/POST /admin/permissions/*` | CRUD via modals + export + bulk delete |
| `SecurityController` | `GET /admin/security/*` | `index()`, `show()`, `blockIp()`, `unblockIp()`, `export()`, `exportPdf()` |

### `stubs/routes/web.php`

Defines all URL routes for the application:

```
GET  /                  → FrontendController::index        (public)
GET  /dashboard         → DashboardController::index       (auth required)
GET  /admin/users       → UserController::index            (auth required)
...etc
```

All admin routes are wrapped in `auth:sanctum`, `verified`, and `config('jetstream.auth_session')` middleware, which ensures only logged-in, verified users can access them.

### `stubs/config/fortify.php`

The most important setting here is:

```php
'home' => '/dashboard',
```

Without this, Fortify redirects users to `/home` after login — a route that doesn't exist in this app. This file ensures users are sent to `/dashboard`.

### `stubs/database/seeders/`

| File | What it creates |
|------|----------------|
| `DatabaseSeeder.php` | Orchestrates the other seeders — calls RolePermissionSeeder then UserSeeder |
| `RolePermissionSeeder.php` | Creates 5 roles (super-admin, admin, manager, user, viewer) and all permissions (dashboard.view, users.view, users.create, etc.), then assigns permissions to roles |
| `UserSeeder.php` | Creates 6 demo users at @apexglobal.com with `password` as the password and assigns each a role |

---

## 11. The `.github/` Folder — CI/CD

```
.github/
└── workflows/
    └── ci.yml    ← GitHub Actions workflow
```

`ci.yml` defines automated checks that run on every push to GitHub:
- Install PHP dependencies via Composer
- Run PHPUnit tests (if any)
- Check code style

This ensures the package doesn't break on every change before it reaches Packagist.

---

## 12. How `apex:install` Works Step by Step

When you run `php artisan apex:install`, here is exactly what happens inside `InstallCommand.php`:

```
Step 1: Publishing [apex-config]
        Copies config/theme.php       → app/config/theme.php
        Copies config/permission.php  → app/config/permission.php
        Copies stubs/config/fortify   → app/config/fortify.php

Step 2: Publishing [apex-views]
        Copies resources/views/frontend/   → app/resources/views/frontend/
        Copies resources/views/backend/    → app/resources/views/backend/
        Copies resources/views/auth/       → app/resources/views/auth/
        Copies resources/views/profile/    → app/resources/views/profile/
        Copies resources/views/components/ → app/resources/views/components/

Step 3: Publishing [apex-welcome]
        Copies stubs/resources/views/welcome.blade.php → app/resources/views/welcome.blade.php
        (always forced — replaces Laravel's default welcome page)

Step 4: Publishing [apex-assets]
        Copies resources/assets/ → app/public/assets/
        (CSS, JS, images used by the views)

Step 5: Publishing [apex-stubs]
        Copies all stubs/app/ files into app/app/
        Copies stubs/routes/web.php → app/routes/web.php
        Copies stubs/database/seeders/ → app/database/seeders/

Step 6: registerProviders()
        Reads bootstrap/providers.php
        If FortifyServiceProvider not found → injects it
        If JetstreamServiceProvider not found → injects it
        Writes file back — never overwrites existing providers

Step 7: updateEnvAppName()
        Reads .env
        Replaces APP_NAME=... with APP_NAME="Apex Starter Kit"

Step 8: Prints next steps to the terminal
```

---

## 13. Data Flow — From Request to Response

Let's trace a request to `GET /dashboard`:

```
Browser → GET /dashboard
    ↓
public/index.php
    ↓
bootstrap/app.php  (creates Application)
    ↓
bootstrap/providers.php  (loads FortifyServiceProvider, JetstreamServiceProvider, etc.)
    ↓
routes/web.php  (matches /dashboard → DashboardController::index)
    ↓
Middleware: auth:sanctum  (is the user logged in? no → redirect to /login)
Middleware: verified      (is email verified?)
    ↓
DashboardController::index()
    ↓
    Queries database:
    - User::count()
    - SecurityLog::whereDate(...)->count()   (production only)
    - User::join(roles)->groupBy(...)        (chart data)
    ↓
    return view('backend.dashboard.index', $data)
    ↓
Blade compiles backend/dashboard/index.blade.php
    → @extends('backend.layouts.app')
    → layout wraps the content with sidebar, header, footer
    → {{ $totalUsers }}, chart data injected as JSON
    ↓
HTML response sent to browser
    ↓
Browser renders page (Tailwind CSS styles, Chart.js draws graphs)
```

---

## 14. The Role & Permission System

Powered by `spatie/laravel-permission`. The key concepts:

**Roles** are named groups: `super-admin`, `admin`, `manager`, `user`, `viewer`.

**Permissions** are named abilities: `users.view`, `users.create`, `users.edit`, `users.delete`, `roles.view`, `security.view`, etc.

**How they connect:**
```
User ──has many──► Roles ──has many──► Permissions
```

**In a controller**, you check permissions like this:
```php
$this->authorize('users.edit');
// or
if (auth()->user()->can('users.delete')) { ... }
// or in Blade:
@can('roles.view')
    <a href="/admin/roles">Roles</a>
@endcan
```

**The seeder sets up:**
- `super-admin` gets every permission
- `admin` gets most permissions except dangerous ones
- `manager` gets view + create permissions
- `viewer` gets only view permissions
- `user` gets minimal permissions

The `RoleController` and `PermissionController` let admins create new roles/permissions and assign them via the UI without touching code.

---

## 15. The Security Log System

Security logging happens in `FortifyServiceProvider` via a Laravel Event listener:

```php
Event::listen(Login::class, function (Login $event) {
    $user = $event->user;
    $user->update([
        'last_login_at' => now(),
        'last_login_location' => request()->input('location'),
    ]);
});
```

The `security_logs` table is written to by `SecurityController` (or middleware you can add). `SecurityController` provides:

- **`index()`** — paginated, filterable list of all security events
- **`show()`** — detail view of a single log entry
- **`blockIp()`** — adds an IP to a blocklist (stored in config/cache)
- **`unblockIp()`** — removes an IP from the blocklist
- **`export()`** — streams a CSV download of logs
- **`exportPdf()`** — generates a PDF using `backend/exports/security-pdf.blade.php`

Security logs are **only loaded in production** (`app()->isProduction()`). In local development they return zeros to avoid SQLite compatibility issues and keep the dashboard fast.

---

## 16. How to Make Changes and Release

### Changing a view

1. Edit the file in `resources/views/` (the package source)
2. If you want the test app to use the new view: `php artisan apex:install` (re-publishes)
3. Commit, tag, push

### Changing a stub (controller, model, route, etc.)

1. Edit the file in `stubs/`
2. Re-run `php artisan apex:install` in the test app to republish
3. Commit, tag, push

### Adding a new config option

1. Add the key to `config/theme.php` or `config/permission.php`
2. Reference it in views as `config('theme.your_key')`
3. Republish

### Releasing a new version

```bash
git add .
git commit -m "feat: description of change"
git push origin main
git tag v1.0.6
git push origin v1.0.6
```

Packagist auto-updates via the GitHub webhook. Users run `composer update apexglobal/apex-starter-kit` to get it.

### Version numbering (Semantic Versioning)

```
v MAJOR . MINOR . PATCH
      1 .     0 .     6

PATCH  →  bug fixes, no new features      v1.0.5 → v1.0.6
MINOR  →  new features, backward compat  v1.0.6 → v1.1.0
MAJOR  →  breaking changes               v1.1.0 → v2.0.0
```

---

## 17. Glossary

| Term | Meaning |
|------|---------|
| **Artisan** | Laravel's command-line tool (`php artisan ...`) |
| **Blade** | Laravel's HTML templating language (`.blade.php` files) |
| **Composer** | PHP's package manager — installs and updates packages |
| **Controller** | PHP class that handles a web request and returns a response |
| **Eloquent** | Laravel's ORM — lets you work with database tables as PHP objects |
| **Facade** | A static-style interface to a Laravel service (e.g. `DB::`, `Route::`) |
| **Fortify** | Laravel's headless authentication engine — handles login, register, reset, 2FA |
| **Guard** | Which authentication system is used (e.g. `web` for sessions, `api` for tokens) |
| **Jetstream** | Laravel's full-stack application starter — provides profile, 2FA, team UI using Livewire |
| **Livewire** | A full-stack framework for Laravel that makes components reactive without writing JavaScript |
| **Middleware** | Code that runs before/after a request reaches the controller (e.g. auth check) |
| **Migration** | A PHP file that defines a database table structure and can be run/rolled back |
| **Model** | A PHP class that represents a database table (e.g. `User`, `SecurityLog`) |
| **ORM** | Object-Relational Mapper — maps database rows to PHP objects |
| **Packagist** | The public PHP package registry at packagist.org |
| **Provider** | A Service Provider — a class that registers and boots package features into Laravel |
| **PSR-4** | A PHP standard for autoloading: namespace maps to folder path |
| **Route** | A URL pattern mapped to a controller method |
| **Sanctum** | Laravel's lightweight API token and session authentication package |
| **Seeder** | A PHP class that inserts test/demo data into the database |
| **Service Container** | Laravel's IoC container — manages class dependencies and injection |
| **Spatie Permission** | A popular package for roles and permissions in Laravel |
| **Stub** | A template file that gets copied into the app during installation |
| **Tailwind CSS** | A utility-first CSS framework — you style elements with class names like `bg-blue-500` |
| **Vendor** | The `vendor/` folder where Composer installs all packages |
| **Webhook** | An HTTP callback — Packagist registers one on GitHub so it gets notified on every push |
