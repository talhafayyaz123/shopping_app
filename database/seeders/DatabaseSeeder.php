<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(BannersSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ColorTableSeeder::class);
        $this->call(SizeTableSeeder::class);
        $this->call(ProductTableSeeder::class);
    }
}
