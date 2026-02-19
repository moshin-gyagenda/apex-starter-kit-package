# Apex Starter Kit – Installation Guide

This guide walks you through installing and running Apex Starter Kit in a new or existing Laravel application.

---

## Prerequisites

- PHP >= 8.2  
- Laravel >= 11.0  
- Composer  
- Node.js >= 18 (for building frontend assets, if needed)

---

## Step 1: Install the package

From your Laravel project root:

```bash
composer require apexglobal/apex-starter-kit
```

---

## Step 2: Run the installer

```bash
php artisan apex:install
```

The installer will:

1. Publish configuration files (`config/theme.php`, `config/permission.php`)
2. Publish all views (frontend, backend, auth, profile, components)
3. Publish assets to `public/assets`
4. Publish application code (Fortify/Jetstream actions, service providers, controllers, models, routes, seeders)
5. Replace the default Laravel welcome page with the Apex Starter Kit frontend
6. Update `.env`: `APP_NAME="Apex Starter Kit"`

To overwrite existing published files:

```bash
php artisan apex:install --force
```

---

## Step 3: Publish Spatie Permission migrations

Required for roles and permissions:

```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

---

## Step 4: Run migrations

```bash
php artisan migrate
```

This runs your app migrations plus those provided by the package (e.g. security logs, user login fields).

---

## Step 5: Seed the database (optional)

To create roles, permissions, and 6 sample users:

```bash
php artisan db:seed
```

- **RolePermissionSeeder** – Roles (super-admin, admin, manager, user, viewer) and Apex Starter Kit permissions.
- **UserSeeder** – 6 users @apexglobal.com (password: `password`): Mosh (super-admin), Ashiraf (admin), Jorine (manager), Ronnie (viewer), Taylor (user), Morgan (user).

Edit `database/seeders/UserSeeder.php` to change them.

---

## Step 6: Start the application

```bash
php artisan serve
```

Open **http://localhost:8000** in your browser.

- **/** – Frontend (Apex Starter Kit landing)
- **/login** – Login
- **/register** – Registration
- **/dashboard** – Dashboard (after login; stats, charts, recent activity)
- **/admin/users** – User management
- **/admin/roles** – Roles (create/edit in modals)
- **/admin/permissions** – Permissions (create/edit in modals)
- **/admin/security** – Security logs and IP actions

---

## Post-installation

- **Theme:** Edit `config/theme.php` to change the primary color.
- **Views:** All views are in `resources/views/` and can be edited.
- **Env:** `APP_NAME` is set to `"Apex Starter Kit"` by the installer; you can change it in `.env`.

For more options and customization, see [README.md](README.md).
