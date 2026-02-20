# Apex Starter Kit

**Stop building the same boilerplate. Ship faster.**

A production-ready Laravel starter kit that gives you a full admin panel, authentication, role-based access control, security monitoring, and a beautiful UI — all installed with a single command.

[![Latest Version](https://img.shields.io/packagist/v/apexglobal/apex-starter-kit.svg?style=flat-square)](https://packagist.org/packages/apexglobal/apex-starter-kit)
[![Total Downloads](https://img.shields.io/packagist/dt/apexglobal/apex-starter-kit.svg?style=flat-square)](https://packagist.org/packages/apexglobal/apex-starter-kit)
[![License](https://img.shields.io/packagist/l/apexglobal/apex-starter-kit.svg?style=flat-square)](https://packagist.org/packages/apexglobal/apex-starter-kit)
[![PHP](https://img.shields.io/badge/PHP-8.2%2B-blue?style=flat-square)](https://www.php.net)
[![Laravel](https://img.shields.io/badge/Laravel-11%2B%20%7C%2012%2B-red?style=flat-square)](https://laravel.com)

---

## Why Apex Starter Kit?

Most Laravel starter kits give you authentication and nothing else. **Apex gives you everything your app needs on day one:**

- A polished public-facing frontend landing page
- Full authentication (login, register, password reset, 2FA)
- A complete admin backend with real charts and live stats
- Role-based access control (RBAC) with fine-grained permissions
- Security logs that track every login and suspicious activity
- IP blocking to lock out bad actors instantly
- CSV and PDF exports on every major data table
- Bulk actions, searchable selects, and per-page pagination throughout
- A single config file to change the entire theme colour

Built on **Laravel + Jetstream + Livewire + Tailwind CSS + Spatie Permission**.

---

## What's included

| Feature | Details |
|---------|---------|
| **Frontend landing page** | Hero, features, and contact section — ready to customise |
| **Authentication** | Login, register, email verification, password reset, 2FA (Fortify + Jetstream) |
| **Admin dashboard** | Live stats: total users, verified users, roles, security events. Charts: users by role (doughnut), security activity by month (bar) |
| **User management** | Full CRUD with role assignment, search, sort, per-page pagination, CSV export, PDF export, bulk delete |
| **Role management** | Create, edit, and delete roles with permission assignment via modal — no page reloads |
| **Permission management** | Granular permissions (dashboard, users, security, roles, settings, reports, and more). Bulk actions, export |
| **Security logs** | Automatic logging of logins and auth events with IP, user agent, location, and timestamp |
| **IP blocking** | Block and unblock IP addresses directly from the security panel |
| **Security exports** | Export full security logs as CSV or PDF |
| **Profile management** | Update profile info and password (Jetstream) |
| **Theme system** | One line in `config/theme.php` changes the entire primary colour across the UI |
| **Dark mode support** | UI respects the user's system dark mode preference |
| **Seeded demo data** | 5 roles, full permission set, and 6 demo users ready to log in |

---

## Quick start

### Requirements

- PHP >= 8.2
- Laravel >= 11.0
- Composer
- Node.js >= 18

### 1. Require the package

```bash
composer require apexglobal/apex-starter-kit
```

### 2. Run the installer

```bash
php artisan apex:install
```

One command publishes everything: config, views, assets, controllers, models, routes, seeders, and service providers.

### 3. Publish Spatie Permission migrations

```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

### 4. Run migrations

```bash
php artisan migrate
```

### 5. (Optional) Seed demo data

```bash
php artisan db:seed
```

Creates 5 roles, a full permission set, and 6 demo users (password: `password`):

| Email | Role |
|-------|------|
| mosh@apexglobal.com | super-admin |
| ashiraf@apexglobal.com | admin |
| jorine@apexglobal.com | manager |
| ronnie@apexglobal.com | viewer |
| taylor@apexglobal.com | user |
| morgan@apexglobal.com | user |

### 6. Build assets and serve

```bash
npm install && npm run build
php artisan serve
```

Visit **http://localhost:8000** — your app is ready.

---

## What you get out of the box

```
/                    → Public landing page
/login               → Authentication
/dashboard           → Admin dashboard with live stats and charts
/admin/users         → User management (CRUD, export, bulk delete)
/admin/roles         → Role management (modal-based, no page reloads)
/admin/permissions   → Permission management (modal-based)
/admin/security      → Security logs, IP blocking, exports
/user/profile        → Profile and password management
```

---

## Customisation

### Change the theme colour

```php
// config/theme.php
'primary' => '#F97316',  // any hex colour
```

That one value updates buttons, links, highlights, and accents across the entire UI.

### Edit views and controllers

Everything is published into your app — views under `resources/views/`, controllers under `app/Http/Controllers/`. You own the code and can modify anything freely.

---

## Installer options

By default `apex:install` overwrites all existing files so nothing is skipped. Use `--safe` to preserve files you have already customised.

| Option | Description |
|--------|-------------|
| *(no flags)* | Install and overwrite everything — recommended for fresh installs |
| `--safe` | Skip files that already exist (preserves your customisations) |
| `--config-only` | Publish only config files |
| `--views-only` | Publish only views |
| `--assets-only` | Publish only assets |
| `--stubs-only` | Publish only code stubs (actions, providers, controllers, etc.) |

```bash
php artisan apex:install              # Fresh install — overwrites everything
php artisan apex:install --safe       # Re-install — skip existing files
php artisan apex:install --views-only # Only re-publish views
```

---

## Tech stack

| Layer | Package |
|-------|---------|
| Framework | Laravel 11 / 12 |
| Authentication | Laravel Jetstream + Fortify |
| Reactive UI | Livewire 3 |
| Styling | Tailwind CSS |
| Roles & Permissions | Spatie Laravel Permission |
| PDF export | barryvdh/laravel-dompdf |

---

## Support

- **Email:** contact@apexglobal.com
- **Issues:** [GitHub Issues](https://github.com/moshin-gyagenda/apex-starter-kit-package/issues)
- **License:** [MIT](LICENSE)

---

**Apex Starter Kit** by Apex Global Technologies — *build less boilerplate, ship more product.*
