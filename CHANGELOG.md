# Changelog

All notable changes to this project are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added

- Roles & Permissions: RoleController and PermissionController (create/edit via modals on index pages)
- Export: CSV and PDF for Users, Roles, Permissions, and Security logs (all or selected)
- Bulk actions: bulk delete and bulk export (CSV/PDF) with row checkboxes on Users, Roles, Permissions
- Pagination: per-page selector (10, 15, 25, 50, 100) on all backend list pages; shared `pagination.blade.php` partial
- Dashboard: real stats (total users, verified users, roles, security events), Users by Role pie chart, Security Activity by Month bar chart, Recent Security Activity, Latest Users
- Sidebar: Roles & Permissions section (key-round icon); Settings last with Account only; order: Dashboard → User Management → Roles & Permissions → Security Monitoring → Settings
- UserSeeder: 6 sample users @apexglobal.com (Mosh, Ashiraf, Jorine, Ronnie, Taylor, Morgan) with roles; password `password`
- RolePermissionSeeder: Apex-aligned permissions and roles (super-admin, admin, manager, user, viewer)
- Backend export views: `backend/exports/users-pdf`, `roles-pdf`, `permissions-pdf`, `security-pdf`

### Changed

- Routes: added roles/permissions resource routes and export/bulk/data routes; security export PDF route
- DashboardController: passes real data for metrics and charts
- UserController: getUsersQuery, exportCsv, exportPdf, bulkDestroy, per-page pagination, stats
- SecurityController: getLogsQuery, exportPdf, per-page pagination, stats
- Package now publishes RoleController and PermissionController stubs
- README and INSTALLATION: 6 sample users, Roles & Permissions, export/bulk/pagination, DomPDF dependency

### Technical

- Added `barryvdh/laravel-dompdf` to package requirements for PDF export

---

## [1.0.0] - 2025-02-19

### Added

- Initial release
- Frontend: landing layout, hero, features, contact section
- Authentication: login, register, password reset (Laravel Fortify + Jetstream)
- Admin dashboard with statistics layout
- User management with CRUD and role assignment (Spatie Permission)
- Security logs and IP blocking
- Profile and password management views
- Theme customization via `config/theme.php`
- Roles and permissions seeders (super-admin, admin, manager, editor, user, guest)
- Default admin user seeder (Apex Global)
- Installation command: `php artisan apex:install`
- Automatic `.env` update: `APP_NAME="Apex Starter Kit"`
- Replacement of default Laravel welcome page with Apex Starter Kit frontend

### Technical

- Laravel Jetstream (Livewire stack)
- Spatie Laravel Permission
- Tailwind CSS
- Migrations for security logs and user login fields
