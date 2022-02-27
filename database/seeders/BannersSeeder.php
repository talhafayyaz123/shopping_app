<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Image;
use Illuminate\Database\Seeder;

class BannersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name'=>'slider_1',
            'type'=>'sliders',
            'status'=>'1',
            'order'=>'1',
        ];
        $banner = Banner::create($data);
        $image_data = [
            'model_id' => $banner->id,
            'model_type' => 'App\Models\Banner',
            'image' => 'slider1.jpg',
        ];
        $banner_image = Image::create($image_data);
    }
}
