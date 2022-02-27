<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'admin','manger','customer'
        ];
        foreach ($roles as $role) {
            $role = Role::create(
                [
                    'name' => $role,
                    'guard_name'=> 'web',
                ]
            );
            $permissions = Permission::pluck('id')->toArray();
            $role->syncPermissions($permissions);
        }
    }
}
