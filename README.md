# Apex Starter Kit

A Laravel starter kit with a modern UI, authentication, roles & permissions, and an admin backend. Built with Laravel, Jetstream, Spatie Permission, Tailwind CSS, and DomPDF.

[![Latest Version](https://img.shields.io/packagist/v/apexglobal/apex-starter-kit.svg?style=flat-square)](https://packagist.org/packages/apexglobal/apex-starter-kit)
[![Total Downloads](https://img.shields.io/packagist/dt/apexglobal/apex-starter-kit.svg?style=flat-square)](https://packagist.org/packages/apexglobal/apex-starter-kit)
[![License](https://img.shields.io/packagist/l/apexglobal/apex-starter-kit.svg?style=flat-square)](https://packagist.org/packages/apexglobal/apex-starter-kit)

---

## Requirements

- **PHP** >= 8.2  
- **Laravel** >= 11.0  
- **Composer**  
- **Node.js** >= 18 (for frontend assets)

---

## Installation

### 1. Require the package

```bash
composer require apexglobal/apex-starter-kit
```

### 2. Run the installer

```bash
php artisan apex:install
```

This will:

- Publish config (`config/theme.php`, `config/permission.php`)
- Publish views (frontend, backend, auth, profile, components)
- Publish assets to `public/assets`
- Publish Fortify/Jetstream actions, providers, controllers, models, routes, and seeders
- Replace the default welcome page with the Apex Starter Kit frontend
- Set `APP_NAME="Apex Starter Kit"` in your `.env`

### 3. Publish Spatie Permission migrations (first time only)

```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

### 4. Run migrations

```bash
php artisan migrate
```

### 5. (Optional) Seed database

```bash
php artisan db:seed
```

- **RolePermissionSeeder** – Roles (super-admin, admin, manager, user, viewer) and permissions (dashboard, users, security, roles, settings, etc.).
- **UserSeeder** – 6 sample users @apexglobal.com (password: `password`): Mosh (super-admin), Ashiraf (admin), Jorine (manager), Ronnie (viewer), Taylor (user), Morgan (user).

### 6. Start the app

```bash
php artisan serve
```

Visit: **http://localhost:8000**

---

## What’s included

| Area | Description |
|------|-------------|
| **Frontend** | Landing layout, hero, features, contact section |
| **Auth** | Login, register, password reset (Fortify + Jetstream) |
| **Dashboard** | Real stats (users, roles, security), charts (users by role, security by month), recent activity |
| **Users** | User CRUD with roles; export CSV/PDF; bulk delete; per-page pagination |
| **Roles & Permissions** | Roles and permissions (create/edit via modals); export and bulk actions |
| **Security** | Security logs, filters, block/unblock IPs; export CSV/PDF; per-page pagination |
| **Profile** | Profile and password management |
| **Theme** | Single config for primary color (`config/theme.php`) |

---

## Install command options

| Option | Description |
|--------|-------------|
| `--force` | Overwrite existing published files |
| `--config-only` | Publish only config files |
| `--views-only` | Publish only views |
| `--assets-only` | Publish only assets |
| `--stubs-only` | Publish only code stubs (actions, providers, controllers, etc.) |

Examples:

```bash
php artisan apex:install --force
php artisan apex:install --config-only
```

---

## Customization

### Theme color

Edit `config/theme.php`:

```php
'primary' => '#F97316',  // e.g. orange
```

### Views and assets

All views are published under `resources/views/` (frontend, backend, auth, profile, components). You can edit them directly. Assets are in `public/assets`.

### Sample users

After `php artisan db:seed`, 6 users are created at @apexglobal.com (password: `password`). Edit `database/seeders/UserSeeder.php` to change them. The installer publishes `RoleController` and `PermissionController` plus routes for roles and permissions.

---

## Package structure (for reference)

```
apex-starter-kit-package/
├── config/           # theme.php, permission.php
├── database/
│   └── migrations/   # security_logs, login fields for users
├── resources/
│   ├── assets/       # Published to public/assets
│   └── views/        # frontend, backend, auth, profile, components
├── stubs/            # Published into your app (actions, controllers, models, routes, seeders)
└── src/
    ├── ApexStarterKitServiceProvider.php
    └── Commands/InstallCommand.php
```

---

## Documentation

- **[INSTALLATION.md](INSTALLATION.md)** – Step-by-step installation and first run  
- **[LOCAL-TESTING.md](LOCAL-TESTING.md)** – Test the package locally (path repository, no Packagist)  
- **[CHANGELOG.md](CHANGELOG.md)** – Version history  
- **[DEVELOPING.md](DEVELOPING.md)** – Package layout and re-publish commands (for contributors)

---

## Support

- **Email:** contact@apexglobal.com  
- **License:** [MIT](LICENSE)

---

**Apex Starter Kit** by Apex Global Technologies.
