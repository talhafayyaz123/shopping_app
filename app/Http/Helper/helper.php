<?php

use App\Models\Category;

function getParentCategories()
{
    $categories = Category::whereNull('parent_id')->select('id', 'name')->get();
    return $categories;
}

function allCategories()
{
    $cateogories = Category::where('is_active', 1)->whereHas('products')->get();
    return $cateogories;
}

function allSizes()
{
    $sizes = \App\Models\Size::where('is_active', 1)->get();
    return $sizes;
}

function allColors()
{
    $colors = \App\Models\Color::where('is_active', 1)->get();
    return $colors;
}

function print_array($array)
{
    echo "<pre>";
    print_r($array);
    die();
}

    function get_vairant_reviews($id)
{
    $rating = \App\Models\ProductReview::selectRaw('COUNT(*) AS total_reviews , avg(rating) AS avg_rating')->where('variant_id', $id)->first();
    return $rating;
}

function getCountries()
{
    $countries = \App\Models\Country::all();
    return $countries;
}

function wishlistItems()
{

    $user_wishlists = array();

    if (Cookie::get('cart')) {

        $cart = (json_decode(Cookie::get('cart'), true));

        foreach ($cart as $key => $item) {
            $cart_items_arr[] = $item['variant_id'];
        }


        if (!empty($cart_items_arr)) {
            $user_wishlists = DB::table('products')
                ->select('products.id as product_id', 'products.name', 'products.sku', 'product_variants.id as variant_id',
                    'product_variants.price', 'product_variants.quantity', 'product_variants.is_discounted',
                    'product_variants.discount_price')
                ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
                ->whereIN('product_variants.id', $cart_items_arr)
                ->where('product_variants.quantity', '>', 0)
                ->get();
        }


    }

    return $user_wishlists;
}

function remove_item_cookie($variant_id)
{
    if (Cookie::get('cart')) {
        $data = (json_decode(Cookie::get('cart'), true));

        foreach ($data as $k => $item) {
            if ($item['variant_id'] == $variant_id) {

                unset($data[$k]);

                if (count($data) > 0) {
                    Cookie::queue('cart', json_encode($data), 60);
                } else {
                    unset($_COOKIE['cart']);
                    setcookie('cart', '', time() - 3600, '/');
                }

            }
        }
    }
}

function categories_with_products(){
    $categories = Category::where('parent_id',null)->get();
    return $categories;
}

function showDate($date){
    $date = \Carbon\Carbon::parse($date)->toFormattedDateString();
    return $date;
}
