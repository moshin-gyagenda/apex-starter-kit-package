<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Seed 6 sample users with different roles for Apex Starter Kit.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Mosh',
                'email' => 'mosh@apexglobal.com',
                'password' => 'password',
                'role' => 'super-admin',
                'email_verified_at' => true,
            ],
            [
                'name' => 'Ashiraf',
                'email' => 'ashiraf@apexglobal.com',
                'password' => 'password',
                'role' => 'admin',
                'email_verified_at' => true,
            ],
            [
                'name' => 'Jorine',
                'email' => 'jorine@apexglobal.com',
                'password' => 'password',
                'role' => 'manager',
                'email_verified_at' => true,
            ],
            [
                'name' => 'Ronnie',
                'email' => 'ronnie@apexglobal.com',
                'password' => 'password',
                'role' => 'viewer',
                'email_verified_at' => false,
            ],
            [
                'name' => 'Taylor',
                'email' => 'taylor@apexglobal.com',
                'password' => 'password',
                'role' => 'user',
                'email_verified_at' => true,
            ],
            [
                'name' => 'Morgan',
                'email' => 'morgan@apexglobal.com',
                'password' => 'password',
                'role' => 'user',
                'email_verified_at' => true,
            ],
        ];

        foreach ($users as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make($data['password']),
                    'email_verified_at' => $data['email_verified_at'] ? now() : null,
                ]
            );

            $role = Role::findByName($data['role']);
            if ($role && ! $user->hasRole($data['role'])) {
                $user->assignRole($data['role']);
            }
        }
    }
}
