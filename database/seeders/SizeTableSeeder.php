<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = [
            'SM','M','L','XL','XXL','XXXL'
        ];
        foreach ($sizes as $size) {
            Size::create(
                [
                    'name' => $size,
                    'type'=> $size,
                    'is_active' => 1
                ]
            );
        }
    }
}
