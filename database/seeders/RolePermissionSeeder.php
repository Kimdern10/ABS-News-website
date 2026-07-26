<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $superAdmin = Role::findByName('super-admin');
        $admin = Role::findByName('admin');
        $editor = Role::findByName('editor');

        // Super Admin gets everything
        $superAdmin->syncPermissions(Permission::all());

        // Admin
        $admin->syncPermissions([
            'view dashboard',
            'view users',
            'create posts',
            'edit posts',
            'delete posts',
            'publish posts',
            'create categories',
            'edit categories',
            'delete categories',
            'create tags',
            'edit tags',
            'delete tags',
            'approve comments',
            'delete comments',
            'send newsletter',
            'manage subscribers',
            'manage ads',
            'manage media',
            'manage live news',
            'manage eyewitness',
            'manage radio',
            'manage seo',
            'view analytics',
            'manage youtube live',
        ]);

        // Editor
        $editor->syncPermissions([
            'view dashboard',
            'create posts',
            'edit posts',
            'publish posts',
            'manage media',
        ]);
    }
}