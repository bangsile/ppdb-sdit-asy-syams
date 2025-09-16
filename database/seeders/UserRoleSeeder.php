<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $this->role();
        $this->user();
    }

    public function user()
    {
        $user = \App\Models\User::create([
            'name' => "superadmin",
            'email' => "superadmin@mail.com",
            'password' => Hash::make('a'),
        ]);
        $user->assignRole('superadmin');
    }

    public function role()
    {
        Role::create(['name' => 'superadmin']);
        Role::create(['name' => 'admin']);
    }
}
