<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [

            // Dashboard
            'view dashboard',

            // Users
            'create users',
            'edit users',
            'delete users',
            'view users',

            // Roles
            'assign roles',
            'manage permissions',

            // Posts
            'create posts',
            'edit posts',
            'delete posts',
            'publish posts',
            'view posts',

            // Categories
            'create categories',
            'edit categories',
            'delete categories',

            // Tags
            'create tags',
            'edit tags',
            'delete tags',

            // Comments
            'approve comments',
            'delete comments',

            // Newsletter
            'send newsletter',
            'manage subscribers',

            // Ads
            'manage ads',

            // Media
            'manage media',

            // Live News
            'manage live news',

            // Eye Witness
            'manage eyewitness',

            // Radio
            'manage radio',

            'manage youtube live',

            // SEO
            'manage seo',

            // Website
            'manage settings',

            // Analytics
            'view analytics',

            // Backup
            'backup database',

            // Logs
            'view logs',

        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }
    }
}