<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'parent_id' => null,
            'level' => null,
            'category_order' => 1,
            'name' => 'Fashion',
            'slug' => 'fashion',
            'short_description' => 'Added By default',
            'is_active' => 1,
            'created_by' => 1,
            'update_by' => 1,
        ];
        Category::create($data);
    }
}
