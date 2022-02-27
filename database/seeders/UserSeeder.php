<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'email' => 'admin@domain.com',
                'f_name' => 'Super ',
                'l_name' => 'Admin',
                'password' => Hash::make('12345678'),
                'phone_no' => '12345678',
                'gender' => 'male',
                'is_active' => 1,
            ],
            [
                'email' => 'user@domain.com',
                'f_name' => 'Test User',
                'l_name' => 'sdfs',
                'password' => Hash::make('12345678'),
                'phone_no' => '12345678',
                'gender' => 'male',
                'is_active' => 1,
            ],
        ];
        $count = 1;
        foreach ($users as $user) {
            $newuser = User::create($user);
            $newuser->assignRole($count++);
        }
    }
}
