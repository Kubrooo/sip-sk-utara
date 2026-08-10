<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions list
        $permissions = [
            'manage_templates',
            'create_submissions',
            'edit_submissions',
            'submit_submissions',
            'verify_kecamatan',
            'verify_hukum',
            'assign_sk_number',
            'approve_camat',
            'sign_tte',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Roles & Assign Permissions
        $kelurahanRole = Role::firstOrCreate(['name' => 'admin_kelurahan']);
        $kelurahanRole->syncPermissions([
            'create_submissions',
            'edit_submissions',
            'submit_submissions',
        ]);

        $kecamatanRole = Role::firstOrCreate(['name' => 'admin_kecamatan']);
        $kecamatanRole->syncPermissions([
            'verify_kecamatan',
            'manage_templates',
        ]);

        $hukumRole = Role::firstOrCreate(['name' => 'bagian_hukum']);
        $hukumRole->syncPermissions([
            'verify_hukum',
            'assign_sk_number',
            'manage_templates',
        ]);

        $camatRole = Role::firstOrCreate(['name' => 'camat']);
        $camatRole->syncPermissions([
            'approve_camat',
            'sign_tte',
        ]);
    }
}
