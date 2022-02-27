<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'banners-list',
            'banners-create',
            'banners-edit',
            'banners-delete',
            'users-list',
            'users-create',
            'users-edit',
            'users-delete',
            'permissions-list',
            'permissions-create',
            'permissions-edit',
            'permissions-delete',
            'coupons-list',
            'coupons-create',
            'coupons-edit',
            'coupons-delete',
        ];


        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
