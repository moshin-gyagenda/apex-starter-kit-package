# Developing Apex Starter Kit

Guide for contributors who need to test the package locally before releasing.

---

## Test in a local Laravel project

### 1. Use a path repository

In your **test** Laravel project’s `composer.json`, add:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "../apex-project-starter-kit/apex-starter-kit-package"
        }
    ]
}
```

Adjust `url` so it points to your package directory.

### 2. Require the package

From the test project root:

```bash
composer require apexglobal/apex-starter-kit:@dev
```

### 3. Install and run

```bash
php artisan apex:install --force
php artisan migrate
php artisan serve
```

### 4. After changing the package

Re-publish and clear caches:

**PowerShell (Windows):**

```powershell
php artisan apex:install --force; php artisan config:clear; php artisan cache:clear; php artisan route:clear; php artisan view:clear
```

**Bash / CMD:**

```bash
php artisan apex:install --force && php artisan config:clear && php artisan cache:clear && php artisan route:clear && php artisan view:clear
```

---

## Package layout

- **config/** – Published as-is  
- **database/migrations/** – Loaded automatically  
- **resources/views/** – Published to `resources/views/`  
- **resources/assets/** – Published to `public/assets`  
- **stubs/** – Published into the app (controllers, models, routes, seeders, etc.)  
- **src/** – Service provider and `apex:install` command  

Changing any of these in the package will apply on the next `apex:install` (use `--force` to overwrite).
