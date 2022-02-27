<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductVariant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Cookie;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function index(){

        $sliders = Banner::where('type','sliders')->whereStatus(1)->get();
        $middle_banner = Banner::where('type','product')->whereStatus(1)->get();
        $latest_product = Product::orderBy('id','desc')->whereHas('variants',function($query){
            $query->where('is_new_arrival',0);
            $query->where('quantity','>',0);
        })->first();

        $latest_new_arrival = Product::whereHas('variants',function($query){
            $query->where('is_new_arrival',0);
            $query->where('quantity','>',0);
        })->orderBy('id','desc')->first();
        $top_categories = Category::wherehas('image')
            ->where(function ($query){
                $query->whereHas('products',function ($product){
                    $product->whereHas('variants',function ($variant){
                       $variant->where('quantity','>',0);
                    });
                })->inRandomOrder()->select('id','name')->take('6');
            })->orwhere(function ($query){
                $query->whereHas('childCatProducts')->inRandomOrder()->select('id','name')->take('6');
            })->get();
        $top_ten_sellers = OrderDetail::with('product')->select('product_id',DB::raw('count(product_id) as p_count'))
            ->groupBy('product_id')
            ->orderBy('p_count','desc')
            ->get();
//        dd($top_ten_sellers[0]->product->variants[0]->price);
        $new_arrivals = Product::with('variants')->whereHas('variants',function($query){
            $query->where('is_new_arrival',1);
            $query->where('quantity','>',0);
        })->get();

        $category_products = Category::with('products')->whereHas('products',function ($query){
            $query->inRandomOrder()->limit('8');
        })->take(3)->get();
        $today_date = Carbon::now()->toDateString();
        $flash_deals = ProductVariant::with('product')
            ->where('quantity','>',0)
            ->where('discount_valid_till','>=',$today_date)
            ->orderBy('discount_valid_till','asc')
            ->take(2)
            ->get();
        $cart=(json_decode(Cookie::get('cart'),true));
        $featured_products = ProductVariant::with('product')
            ->where('quantity','>',0)
            ->where('is_featured',1)
            ->inRandomOrder()->take('5')->get();
        return view('front.home',compact('sliders','middle_banner',
            'latest_new_arrival','top_categories','new_arrivals','category_products',
                'latest_product','flash_deals','cart','featured_products','top_ten_sellers'));
    }
}
