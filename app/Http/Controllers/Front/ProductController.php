<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Helper\HelperModule;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductColorSize;
use App\Models\ProductVariant;
use App\Models\Size;
use App\Models\User;
use App\Models\WishListItems;
use App\Models\ProductReview;

use Illuminate\Http\Request;
use Auth;
use Cookie;
use DB;

class ProductController extends Controller
{
    public function getProducts($category_name)
    {
        $category_products = Category::with('products')->where('name', '=', $category_name)->first();
        $products = Product::where('category_id', $category_products->id)
            ->orWhere('first_child_category', $category_products->id)
            ->orWhere('second_child_category', $category_products->id)
            ->get();
        $cart = (json_decode(Cookie::get('cart'), true));
        return view('front.products', compact('category_products', 'products', 'cart'));
    }
    public function productNameFilter(Request $request)
    {
        $p_name = $request->get('p_name');
        $products = Product::with('firstChildCategory','secondChildCategory','category')
                        ->where('name', 'like' ,'%'.$p_name.'%')
                        ->get();
        return view('front.search_filter', compact( 'products'));
    }

    public function productDetail($id)
    {
        $product = Product::with(['category'])->find($id);  
        $product_id = $id;
        $cart = (json_decode(Cookie::get('cart'), true));
        $reviews = ProductReview::with('customer')->where('product_id', $id)->get();

        return view('front.product_detail', compact('product', 'product_id', 'cart', 'reviews'));
    }

    public function categoryFilter(Request $request)
    {
        $category_id = decrypt($request->get('id'));
        $products = Product::with('category')->where('category_id', $category_id)->get();
        return view('front.filter', compact('products'));
    }


    public function colorFilter($type, $price, $max_price, $sizes, Request $request)
    {
        $cat = $request->get('cat');

        if($cat != ''){
            $category_id = Category::where('name', '=', $cat)->first()->id;
        }
        
         if($cat != ''){
        if ($type == 'price') {
            $range = explode('-', $price);
            if (isset($range[1])) {
                $min_price = $range[0];
                $max_price = $range[1];
                $products = Product::whereHas('variants', function ($query) use ($min_price, $max_price) {
//                dd($query->toSql());
                    $query->whereBetween('price', array($min_price, $max_price));
                })->whereHas('variants.variantSize', function ($query) use ($sizes) {
                    $query->whereIN('color_id', explode('-', $sizes));
                })->where('category_id', $category_id)->get();
            } else {
                $min_price = $range[0];

                $products = Product::with('category')->whereHas('variants.variantSize', function ($query) use ($sizes) {
                    $query->whereIN('color_id', explode('-', $sizes));

                })->whereHas('variants', function ($query) use ($min_price) {
                    $query->where('price', '>', $min_price);

                })->where('category_id', $category_id)->get();
            
            }

            $returnHTML = view('front.filter-products')->with('products', $products)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));

        } else {
            $min_price = $price;
            $max_price = $max_price;
            $products = Product::whereHas('variants', function ($query) use ($min_price, $max_price) {

                $query->whereBetween('price', array($min_price, $max_price));
                // dd($query->toSql());
            })->whereHas('variants.variantSize', function ($query) use ($sizes) {
                $query->whereIN('color_id', explode('-', $sizes));
            })->where('category_id', $category_id)->get();

            $returnHTML = view('front.filter-products')->with('products', $products)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }

       }else{
        if ($type == 'price') {
            $range = explode('-', $price);
            if (isset($range[1])) {
                $min_price = $range[0];
                $max_price = $range[1];
                $products = Product::whereHas('variants', function ($query) use ($min_price, $max_price) {
//                dd($query->toSql());
                    $query->whereBetween('price', array($min_price, $max_price));
                })->whereHas('variants.variantSize', function ($query) use ($sizes) {
                    $query->whereIN('color_id', explode('-', $sizes));
                })->get();
            } else {
                $min_price = $range[0];

                $products = Product::with('category')->whereHas('variants.variantSize', function ($query) use ($sizes) {
                    $query->whereIN('color_id', explode('-', $sizes));

                })->where('selling_price', '>', $min_price)->get();

            }

            $returnHTML = view('front.filter-products')->with('products', $products)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));

        } else {
            $min_price = $price;
            $max_price = $max_price;
            $products = Product::whereHas('variants', function ($query) use ($min_price, $max_price) {

                $query->whereBetween('price', array($min_price, $max_price));
                // dd($query->toSql());
            })->whereHas('variants.variantSize', function ($query) use ($sizes) {
                $query->whereIN('color_id', explode('-', $sizes));
            })->get();

            $returnHTML = view('front.filter-products')->with('products', $products)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
       }




    }


    public function sizeColorFilter($type, $price, $max_price, $sizes, $colors, Request $request)
    {

        $cat = $request->get('cat');
        if($cat != ''){
           $category_id = Category::where('name', '=', $cat)->first()->id;
        }
        

      if($cat != ''){
        if ($type == 'price') {
            $range = explode('-', $price);
            if (isset($range[1])) {
                $min_price = $range[0];
                $max_price = $range[1];
                $products = Product::whereHas('variants', function ($query) use ($min_price, $max_price) {
                    $query->whereBetween('price', array($min_price, $max_price));
                })->whereHas('variants.variantSize', function ($query) use ($sizes, $colors) {
                    $query->whereIN('size_id', explode('-', $sizes))->whereIN('color_id', explode('-', $colors));
                })->where('category_id', $category_id)->get();
            } else {
                $min_price = $range[0];

                $products = Product::with('category')->whereHas('variants.variantSize', function ($query) use ($sizes, $colors) {
                    $query->whereIN('size_id', explode('-', $sizes))->whereIN('color_id', explode('-', $colors));

                })->whereHas('variants', function ($query) use ($min_price) {
                    $query->where('price', '>', $min_price);

                })->where('category_id', $category_id)->get();
                
            }

            $returnHTML = view('front.filter-products')->with('products', $products)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));

        } else {
            $min_price = $price;
            $max_price = $max_price;
            $products = Product::whereHas('variants', function ($query) use ($min_price, $max_price) {

                $query->whereBetween('price', array($min_price, $max_price));
            })->whereHas('variants.variantSize', function ($query) use ($sizes, $colors) {
                $query->whereIN('size_id', explode('-', $sizes))->whereIN('color_id', explode('-', $colors));
            })->where('category_id', $category_id)->get();

            $returnHTML = view('front.filter-products')->with('products', $products)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }

    }else{
        if ($type == 'price') {
            $range = explode('-', $price);
            if (isset($range[1])) {
                $min_price = $range[0];
                $max_price = $range[1];
                $products = Product::whereHas('variants', function ($query) use ($min_price, $max_price) {
                    $query->whereBetween('price', array($min_price, $max_price));
                })->whereHas('variants.variantSize', function ($query) use ($sizes, $colors) {
                    $query->whereIN('size_id', explode('-', $sizes))->whereIN('color_id', explode('-', $colors));
                })->get();
            } else {
                $min_price = $range[0];

                $products = Product::with('category')->whereHas('variants.variantSize', function ($query) use ($sizes, $colors) {
                    $query->whereIN('size_id', explode('-', $sizes))->whereIN('color_id', explode('-', $colors));

                })->where('selling_price', '>', $min_price)->get();

            }

            $returnHTML = view('front.filter-products')->with('products', $products)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));

        } else {
            $min_price = $price;
            $max_price = $max_price;
            $products = Product::whereHas('variants', function ($query) use ($min_price, $max_price) {

                $query->whereBetween('price', array($min_price, $max_price));
            })->whereHas('variants.variantSize', function ($query) use ($sizes, $colors) {
                $query->whereIN('size_id', explode('-', $sizes))->whereIN('color_id', explode('-', $colors));
            })->get();

            $returnHTML = view('front.filter-products')->with('products', $products)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }   
    }

    }

    public function sizeFilter($type, $price, $max_price, $sizes, Request $request)
    {

        $cat = $request->get('cat');
        if($cat != ''){
           $category_id = Category::where('name', '=', $cat)->first()->id;
        }
        

    if($cat != ''){
        if ($type == 'price') {
            $range = explode('-', $price);
            if (isset($range[1])) {
                $min_price = $range[0];
                $max_price = $range[1];
                $products = Product::whereHas('variants', function ($query) use ($min_price, $max_price) {
//                dd($query->toSql());
                    $query->whereBetween('price', array($min_price, $max_price));
                })->whereHas('variants.variantSize', function ($query) use ($sizes) {
                    $query->whereIN('size_id', explode('-', $sizes));
                })->where('category_id', $category_id)->get();
            } else {
                $min_price = $range[0];

                $products = Product::with('category')->whereHas('variants.variantSize', function ($query) use ($sizes) {
                    $query->whereIN('size_id', explode('-', $sizes));

                })->whereHas('variants', function ($query) use ($min_price) {
                    $query->where('price', '>', $min_price);

                })->where('category_id', $category_id)->get();

            }

            $returnHTML = view('front.filter-products')->with('products', $products)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));

        } else {
            $min_price = $price;
            $max_price = $max_price;
            $products = Product::whereHas('variants', function ($query) use ($min_price, $max_price) {
//                dd($query->toSql());
                $query->whereBetween('price', array($min_price, $max_price));
            })->whereHas('variants.variantSize', function ($query) use ($sizes) {
                $query->whereIN('size_id', explode('-', $sizes));
            })->where('category_id', $category_id)->get();

            $returnHTML = view('front.filter-products')->with('products', $products)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }

    }else{
                if ($type == 'price') {
            $range = explode('-', $price);
            if (isset($range[1])) {
                $min_price = $range[0];
                $max_price = $range[1];
                $products = Product::whereHas('variants', function ($query) use ($min_price, $max_price) {
//                dd($query->toSql());
                    $query->whereBetween('price', array($min_price, $max_price));
                })->whereHas('variants.variantSize', function ($query) use ($sizes) {
                    $query->whereIN('size_id', explode('-', $sizes));
                })->get();
            } else {
                $min_price = $range[0];

                $products = Product::with('category')->whereHas('variants.variantSize', function ($query) use ($sizes) {
                    $query->whereIN('size_id', explode('-', $sizes));

                })->where('selling_price', '>', $min_price)->get();

            }

            $returnHTML = view('front.filter-products')->with('products', $products)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));

        } else {
            $min_price = $price;
            $max_price = $max_price;
            $products = Product::whereHas('variants', function ($query) use ($min_price, $max_price) {
//                dd($query->toSql());
                $query->whereBetween('price', array($min_price, $max_price));
            })->whereHas('variants.variantSize', function ($query) use ($sizes) {
                $query->whereIN('size_id', explode('-', $sizes));
            })->get();

            $returnHTML = view('front.filter-products')->with('products', $products)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    }

    public function priceFilter(Request $request)
    {
        $price_limit = $request->get('price_limit');
        $cat = $request->get('cat');
        if($cat != ''){
            $category_id = Category::where('name', '=', $cat)->first()->id;
        }

        $size = $request->get('size');
        $color = $request->get('color');
        if($cat != ''){
            if ($size) {
                $size = explode('-', $size);
                $products = Product::whereHas('variants.variantSize', function ($query) use ($size) {
                    $query->whereIN('size_id', $size);
                })->where('category_id', $category_id)->get();
            } else if ($color) {
                $color = explode('-', $color);
                $products = Product::whereHas('variants.variantSize', function ($query) use ($color) {
                    $query->whereIN('color_id', $color);
                })->where('category_id', $category_id)->get();
            } else if ($price_limit) {
                $range = explode('-', $price_limit);
                if (isset($range[1])) {
                    $min_price = $range[0];
                    $max_price = $range[1];
                    $products = Product::whereHas('variants', function ($query) use ($min_price, $max_price) {
//                dd($query->toSql());
                        $query->whereBetween('price', array($min_price, $max_price));
                    })->where('category_id', $category_id)->get();
                } else {
                    $min_price = $range[0];

                    $products = Product::with('category')->whereHas('variants', function ($query) use ($min_price) {

                      $query->where('price', '>', $min_price);
                     })->where('category_id', $category_id)->get();
                
                }


            } else {

                $min_price = $request->get('min_price');

                $max_price = $request->get('max_price');
                $products = Product::whereHas('variants', function ($query) use ($min_price, $max_price) {
                    $query->whereBetween('price', array($min_price, $max_price));
                })->where('category_id', $category_id)->get();


            }
        }else{
            if ($size) {
                $size = explode('-', $size);
                $products = Product::whereHas('variants.variantSize', function ($query) use ($size) {
                    $query->whereIN('size_id', $size);
                })->get();
            } else if ($color) {
                $color = explode('-', $color);
                $products = Product::whereHas('variants.variantSize', function ($query) use ($color) {
                    $query->whereIN('color_id', $color);
                })->get();
            } else if ($price_limit) {
                $range = explode('-', $price_limit);
                if (isset($range[1])) {
                    $min_price = $range[0];
                    $max_price = $range[1];
                    $products = Product::whereHas('variants', function ($query) use ($min_price, $max_price) {
//                dd($query->toSql());
                        $query->whereBetween('price', array($min_price, $max_price));
                    })->get();
                } else {
                    $min_price = $range[0];

                    $products = Product::with('category')->whereHas('variants', function ($query) use ($min_price) {

                        $query->where('price', '>', $min_price);
                     })->get();

                     

                }
            } else {
                $min_price = $request->get('min_price');
                $max_price = $request->get('max_price');
                $products = Product::whereHas('variants', function ($query) use ($min_price, $max_price) {
                    $query->whereBetween('price', array($min_price, $max_price));
                })->get();


            }
        }


        return view('front.filter', compact('products'));
    }

    public function getColorSizes($color_id, $variant_id)
    {
        $size_ids = ProductColorSize::where('variant_id', $variant_id)->where('color_id', $color_id)->pluck('size_id')->toArray();
        $sizes = Size::whereIN('id', $size_ids)->get();
        $variant = ProductVariant::findOrFail($variant_id);
        $wishlist_found = 0;
        if (Auth::check()) {
            $wishlist = WishListItems::where(['variant_id' => $variant_id, 'user_id' => auth()->user()->id])->first();
            if (!empty($wishlist)) {
                $wishlist_found = 1;
            }
        }
        $product_varient = ProductVariant::find($variant_id);
        $returnHTML = view('front.varient-images')->with('product_varient', $product_varient)->render();
        $reviews = ProductReview::with('customer')->where('variant_id', $variant_id)->get();
        $review_html = view('front.product_reviews')->with('reviews', $reviews)->render();
        $cart_found = 0;
        if (Cookie::get('cart')) {
            $data = (json_decode(Cookie::get('cart'), true));

            $key = array_search($variant_id, array_column($data, 'variant_id'));
            if (FALSE !== $key) {

                $cart_found = 1;

            }
        }
        if($variant->is_discounted == 1){
            $v_price = $variant->price - $variant->dicount_price;
        }else{
            $v_price = $variant->price;
        }
        return response()->json(['status' => true, 'data' => $sizes, 'qty' => $variant->quantity, 'wishlist_found' => $wishlist_found,
            'html' => $returnHTML, 'cart_found' => $cart_found, 'review_html' => $review_html,'variant_price' => $v_price]);
    }

    public function productWishlistUpdate($product_id, $variant_id)
    {

        $wishlist = WishListItems::where(['product_id' => $product_id, 'variant_id' => $variant_id, 'user_id' => auth()->user()->id])->first();

        if (empty($wishlist)) {
            WishListItems::create(
                ['product_id' => $product_id, 'variant_id' => $variant_id, 'user_id' => auth()->user()->id]
            );

        } else {
            WishListItems::where('id', $wishlist->id)->delete();

        }

    }

    public function trackOrder(Request $req){
        if(isset($req->vendor_sku)){
            $variant_sku = $req->get('vendor_sku');
            $email = $req->get('email');
            $user = User::where('email',$email)->first();
            $detail = ProductVariant::where('sku',$variant_sku)->first();
            $order_detail = OrderDetail::with('order')->where('variant_id',$detail->id)
                ->whereHas('order',function ($query) use($user){
                    $query->where('customer_id',$user->id);
            })
            ->get();
            return view('front.tracking',get_defined_vars());
        }else{
            return view('front.tracking');
        }

    }

    public function productSearchFiter($search, $colors, $sizes, $min_max,$price_limit)
    {
     
        $min_max_range = explode('-', $min_max);
        if ($min_max_range[0]==0 && $min_max_range[1]==0 ) {
            $min_max_range=0;
        }
        
     
        if($price_limit !=0 && $min_max_range!=0){
            $price_limit=0;
        }
     
        $products = Product::with('firstChildCategory','secondChildCategory','category')->when( $colors != 0, function ($query) use ($colors) {
             $colors = explode('-', $colors);
             $query->whereHas('variants.variantSize', function ($query) use ($colors) {
                $query->whereIN('color_id', $colors);
             }); 
         })->when( $sizes != 0, function ($query) use ($sizes) {
            $sizes = explode('-', $sizes);
            $query->whereHas('variants.variantSize', function ($query) use ($sizes) {
               $query->whereIN('size_id', $sizes);
            }); 
        })->when( $price_limit != 0, function ($query) use ($price_limit) {
            $range = explode('-', $price_limit);
        
            if (isset($range[1])) {
                $min_price = $range[0];
                $max_price = $range[1];

                $query->whereHas('variants', function ($query) use ($min_price, $max_price) {

                   $query->whereBetween('price', array($min_price, $max_price));
                }); 
            } else {
                $min_price = $range[0];
                $query->whereHas('variants', function ($query) use ($min_price) {

                    $query->where('price', '>', $min_price);
                 }); 
              
            }
        })->when( $min_max_range != 0, function ($query) use ($min_max_range) {

              if($min_max_range[0] !=0 &&   $min_max_range[1] !=0){
                $min_price = $min_max_range[0];
                $max_price = $min_max_range[1];

                $query->whereHas('variants', function ($query) use ($min_price, $max_price) {
                   $query->whereBetween('price', array($min_price, $max_price));
                }); 

              }

              if($min_max_range[0] !=0 &&   $min_max_range[1] ==0){
                $min_price = $min_max_range[0];
                
                $query->whereHas('variants', function ($query) use ($min_price) {

                    $query->where('price', '>=', $min_price);
                 }); 
             
              }

              if($min_max_range[0] ==0 &&   $min_max_range[1] !=0){
                $max_price = $min_max_range[1];
                $query->whereHas('variants', function ($query) use ($max_price) {

                    $query->where('price', '<=', $max_price);
                 }); 
              }
           
        })->where('name', 'like' ,'%'.$search.'%')->get();


         $returnHTML = view('front.filter-products')->with('products', $products)->render();
         return response()->json(array('success' => true, 'html' => $returnHTML));

    
    }

    public function productCategoryFiter($cat, $colors, $sizes, $min_max,$price_limit)
    {
     
        $category_id = Category::where('name', '=', $cat)->first()->id;

      
        $min_max_range = explode('-', $min_max);
        if ($min_max_range[0]==0 && $min_max_range[1]==0 ) {
            $min_max_range=0;
        }
        
     
        if($price_limit !=0 && $min_max_range!=0){
            $price_limit=0;
        }
     
        $products = Product::with('firstChildCategory','secondChildCategory','category')->when( $colors != 0, function ($query) use ($colors) {
             $colors = explode('-', $colors);
             $query->whereHas('variants.variantSize', function ($query) use ($colors) {
                $query->whereIN('color_id', $colors);
             }); 
         })->when( $sizes != 0, function ($query) use ($sizes) {
            $sizes = explode('-', $sizes);
            $query->whereHas('variants.variantSize', function ($query) use ($sizes) {
               $query->whereIN('size_id', $sizes);
            }); 
        })->when( $price_limit != 0, function ($query) use ($price_limit) {
            $range = explode('-', $price_limit);
        
            if (isset($range[1])) {
                $min_price = $range[0];
                $max_price = $range[1];

                $query->whereHas('variants', function ($query) use ($min_price, $max_price) {

                   $query->whereBetween('price', array($min_price, $max_price));
                }); 
            } else {
                $min_price = $range[0];
                $query->whereHas('variants', function ($query) use ($min_price) {

                    $query->where('price', '>', $min_price);
                 }); 
              
            }
        })->when( $min_max_range != 0, function ($query) use ($min_max_range) {

              if($min_max_range[0] !=0 &&   $min_max_range[1] !=0){
                $min_price = $min_max_range[0];
                $max_price = $min_max_range[1];

                $query->whereHas('variants', function ($query) use ($min_price, $max_price) {
                   $query->whereBetween('price', array($min_price, $max_price));
                }); 

              }

              if($min_max_range[0] !=0 &&   $min_max_range[1] ==0){
                $min_price = $min_max_range[0];
                
                $query->whereHas('variants', function ($query) use ($min_price) {

                    $query->where('price', '>=', $min_price);
                 }); 
             
              }

              if($min_max_range[0] ==0 &&   $min_max_range[1] !=0){
                $max_price = $min_max_range[1];
                $query->whereHas('variants', function ($query) use ($max_price) {

                    $query->where('price', '<=', $max_price);
                 }); 
              }
           
        })->where('category_id', $category_id)->get();
         $returnHTML = view('front.filter-products')->with('products', $products)->render();
         return response()->json(array('success' => true, 'html' => $returnHTML));

    
    }
}
