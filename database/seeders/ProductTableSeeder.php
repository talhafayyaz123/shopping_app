<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use App\Models\ProductColorSize;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_array = [
            'name' => 'Test Product',
            'description' => 'Test Product',
            'sku' => 'Prod-sskk',
            'category_id' => 1,
            'is_active' => 1,
        ];
        $product = Product::create($product_array);
        $form_data['account_id'] = 1;
        $form_data['is_new_arrival'] = 1;
        $form_data['product_id'] = $product->id;
        $form_data['color_id'] = 1;
        $form_data['length'] = 1;
        $form_data['height'] = 1;
//        $form_data['weight']= 1;
        $form_data['width'] = 1;
        $form_data['quantity'] = 1;
        $form_data['alert_quantity'] = 1;
        $form_data['price'] = 1;
        $form_data['is_discounted'] = 1;
        $form_data['discount_price'] = 5;
        $form_data['discount_valid_till'] = '2025-12-31';
        $form_data['is_new_arrival'] = 1;
        $form_data['is_featured'] = 1;
        $variant = ProductVariant::create($form_data);

        $sizes =['1','2'];
        foreach($sizes as $key => $size){
            $product_size = new ProductColorSize();
            $product_size->color_id = 1;
            $product_size->size_id = $size;
            $product_size->product_id = $product->id;
            $product_size->variant_id = $variant->id;
            $product_size->save();
        }
            $model = new Image();
            $model->model_id = $variant->id;
            $model->model_type = 'App\Models\ProductVariant';
            $model->image = 'shoes.jpg';
            $model->save();
    }
}
