# Local testing guide

Step-by-step guide to test the **apex-starter-kit** package locally in a Laravel app without publishing to Packagist.

---

## Prerequisites

- PHP >= 8.2, Composer, Node.js >= 18
- Laravel 11 (or 12) app to test in (new or existing)
- Package and test app on the same machine (e.g. sibling folders)

---

## 1. Set up a test Laravel app

If you don’t have one yet:

```bash
composer create-project laravel/laravel apex-test-app
cd apex-test-app
```

Install Jetstream (Livewire stack) and Spatie Permission:

```bash
composer require laravel/jetstream
php artisan jetstream:install livewire
composer require spatie/laravel-permission
```

---

## 2. Link the package via path repository

In the **test app’s** `composer.json`, add a `repositories` section. Point `url` to your **apex-starter-kit-package** folder.

**Example – package and app are siblings (e.g. under `Apex Projects`):**

```json
{
    "name": "laravel/laravel",
    "repositories": [
        {
            "type": "path",
            "url": "../apex-starter-kit-package",
            "options": {
                "symlink": true
            }
        }
    ]
}
```

**Windows (absolute path example):**

```json
"url": "C:/Users/YourName/Desktop/Apex Projects/apex-starter-kit-package"
```

Use forward slashes in the path. Adjust for your actual path.

---

## 3. Require the package

From the **test app** root:

```bash
composer require apexglobal/apex-starter-kit:@dev
```

If you already have the package from Packagist, switch to the path version:

```bash
composer remove apexglobal/apex-starter-kit
composer require apexglobal/apex-starter-kit:@dev
```

---

## 4. Publish Spatie Permission migrations

```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

---

## 5. Run the Apex installer

```bash
php artisan apex:install --force
```

This publishes config, views, stubs (controllers, routes, seeders, etc.), and assets. Use `--force` to overwrite existing files.

---

## 6. Configure environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env`: set database (MySQL/SQLite/PostgreSQL), and optionally mail. The installer sets `APP_NAME="Apex Starter Kit"`.

---

## 7. Run migrations

```bash
php artisan migrate
```

---

## 8. (Optional) Seed database

```bash
php artisan db:seed
```

This creates roles, permissions, and 6 sample users @apexglobal.com (password: `password`). You can log in as **mosh@apexglobal.com** (super-admin).

---

## 9. Build frontend assets

```bash
npm install
npm run build
```

---

## 10. Run the app and verify

```bash
php artisan serve
```

In the browser:

- **/** – Frontend landing
- **/login** – Log in (e.g. mosh@apexglobal.com / password)
- **/dashboard** – Dashboard (stats, charts, recent activity)
- **/admin/users** – User management
- **/admin/roles** – Roles (modals)
- **/admin/permissions** – Permissions (modals)
- **/admin/security** – Security logs

Check that export (CSV/PDF), bulk actions, and per-page pagination work on Users, Roles, and Permissions.

---

## After changing the package

When you edit files **inside** `apex-starter-kit-package`, the test app uses the updated code (with `symlink: true`). For **published** assets (views, stubs, config), re-publish and clear caches:

**PowerShell (Windows):**

```powershell
php artisan apex:install --force; php artisan config:clear; php artisan cache:clear; php artisan route:clear; php artisan view:clear
```

**Bash / Linux / macOS:**

```bash
php artisan apex:install --force && php artisan config:clear && php artisan cache:clear && php artisan route:clear && php artisan view:clear
```

Then reload the app in the browser.

---

## Troubleshooting

| Issue | What to do |
|-------|------------|
| Package not found | Check `repositories` `url` in the test app’s `composer.json`; path must point to the package root. |
| Old views/controllers after package change | Run `php artisan apex:install --force` and clear caches (see above). |
| PDF export fails | Ensure `barryvdh/laravel-dompdf` is installed: `composer require barryvdh/laravel-dompdf`. |
| Routes or 404s | Run `php artisan route:clear` and `php artisan route:list` to confirm admin routes. |
| Symlink problems (Windows) | In `composer.json` you can use `"symlink": false`; then run `composer update apexglobal/apex-starter-kit` after package changes. |

---

## Quick reference: folder layout

```
Apex Projects/
├── apex-starter-kit-package/   ← package you are testing
└── apex-test-app/              ← Laravel app used for local testing
```

In `apex-test-app/composer.json`, use `"url": "../apex-starter-kit-package"` in the path repository.
