<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Permissions and roles aligned with Apex Starter Kit (dashboard, users, security, settings).
     *
     * @return void
     */
    public function run()
    {
        // Permissions for Apex Starter Kit
        $permissions = [
            'view-dashboard',
            'view-content', 'create-content', 'edit-content', 'delete-content',
            'view-tasks', 'create-tasks', 'edit-tasks', 'delete-tasks',
            'view-analytics',
            'view-reports', 'generate-reports', 'export-reports',
            'view-users', 'create-users', 'edit-users', 'delete-users',
            'view-security', 'manage-security',
            'view-roles', 'manage-roles', 'view-permissions', 'manage-permissions',
            'manage-settings',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $roles = ['super-admin', 'admin', 'manager', 'user', 'viewer'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        Role::findByName('super-admin')->syncPermissions($permissions);
        Role::findByName('admin')->syncPermissions([
            'view-dashboard', 'view-content', 'create-content', 'edit-content', 'delete-content',
            'view-tasks', 'create-tasks', 'edit-tasks', 'delete-tasks', 'view-analytics',
            'view-reports', 'generate-reports', 'export-reports',
            'view-users', 'create-users', 'edit-users', 'delete-users',
            'view-security', 'manage-security',
            'view-roles', 'manage-roles', 'view-permissions', 'manage-permissions', 'manage-settings',
        ]);
        Role::findByName('manager')->syncPermissions([
            'view-dashboard', 'view-content', 'create-content', 'edit-content', 'delete-content',
            'view-tasks', 'create-tasks', 'edit-tasks', 'delete-tasks', 'view-analytics',
            'view-reports', 'generate-reports', 'export-reports',
            'view-users', 'create-users', 'edit-users', 'delete-users', 'view-security',
        ]);
        Role::findByName('user')->syncPermissions([
            'view-dashboard', 'view-content', 'create-content', 'edit-content',
            'view-tasks', 'create-tasks', 'edit-tasks', 'view-analytics', 'view-reports',
        ]);
        Role::findByName('viewer')->syncPermissions([
            'view-dashboard', 'view-content', 'view-tasks', 'view-analytics', 'view-reports',
        ]);
    }
}
