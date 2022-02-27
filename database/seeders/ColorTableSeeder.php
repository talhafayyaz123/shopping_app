<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            'Green','Black','Blue','Red','Orange','Gray'
        ];
        foreach ($colors as $color) {
            Color::create(
                [
                'name' => $color,
                'type'=> $color,
                'is_active' => 1
                ]
            );
        }
    }
}
