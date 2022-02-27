<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WishListItems;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\OrderDetail;
use App\Models\ProductVariant;
use App\Models\ProductReview;
use App\Models\Address;
use DB;
use Cookie;
use Auth;
use Mail;
use App\Mail\DefaultMail;
use App\Models\GeneralSetting;
use App\Models\UserCoupon;
use App\Jobs\OrderPlacedEmailJob;


class WishlistProducts extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $wishlistItems = User::with(['wishlistItems.product'])->get();
        $user_wishlists = DB::table('wish_list_items')
            ->select('products.id as product_id', 'products.name', 'products.sku', 'product_variants.id as variant_id', 'product_variants.price', 'wish_list_items.id')
            ->join('products', 'wish_list_items.product_id', '=', 'products.id')
            ->join('product_variants', 'wish_list_items.variant_id', '=', 'product_variants.id')
            ->where('wish_list_items.user_id', auth()->user()->id)
            ->get();

        $cart = (json_decode(Cookie::get('cart'), true));
        return view('front.wishlist', compact('user_wishlists', 'cart'));
    }


    public function cartItems()
    {
        $address = array();
        if (Auth::check()) {
            $address = Address::where('status', 1)->where('customer_id', auth()->user()->id)->first();
        }
        return view('front.cart', compact('address'));
    }


    public function cartOrders()
    {
        $orders = Order::with('order_detail')->where('customer_id', auth()->user()->id)->get();
        $adddress = Address::where('customer_id', auth()->user()->id)->get();

        return view('front.my-account', compact('orders', 'adddress'));
    }


    public function removeWishlistItem($id, $variant_id)
    {
        try {
            remove_item_cookie($variant_id);
            WishListItems::where('id', $id)->delete();
            return response()->json(['status' => 200, 'message' => 'Wishlist Deleted Successfully']);
        } catch (\Exception $exception) {
            return response()->json(['status' => 422, 'message' => $exception->getMessage()]);
        }
    }


    function removeCartItem($variant_id)
    {
        remove_item_cookie($variant_id);
    }

    function productCartUpdate($id, $quantity = 1)
    {
        $minutes = 60;
        $content = [
            [
                'variant_id' => $id,
                'local_qty' => $quantity,
            ]
        ];

        if (Cookie::get('cart')) {
            $data = (json_decode(Cookie::get('cart'), true));
            $key = array_search($id, array_column($data, 'variant_id'));
            if (FALSE === $key) {
                Cookie::queue('cart', json_encode(array_merge($data, $content)), $minutes);
            }
        } else {
            Cookie::queue('cart', json_encode($content), $minutes);
        }
    }

    function getCartItems()
    {
        $returnHTML = view('front.cart_items_nav_bar')->render();
        return response()->json(array('success' => true, 'html' => $returnHTML));
    }


    function orderPlace(Request $request)
    {


      
        $form_data = $request->all();
        $order = Order::where('customer_id', auth()->user()->id)->get();
        $settings = GeneralSetting::first();
        $price = $form_data['cart_sub_total_hidden'];
        $customer_id = auth()->user()->id;
        $order_date_time = date('Y-m-d H:i:s');

        $commission = $settings->comission;

        $is_delivered = 0;
        $sign_up_coupon_discount =  $settings->sign_up_discount;
        $sign_up_discount_percentage_amount = round(($price * $sign_up_coupon_discount ) / 100);
        $commission_fees = round($price *(  $commission / 100 ));
        $discount_price = ($price + $commission_fees)  - $sign_up_discount_percentage_amount;

        if (count($order) == 0) {
            $order_arr = [
                'customer_id' => $customer_id,
                'price' => $price,
                'commission' => $commission,
                'discount' => $sign_up_coupon_discount,
                'order_date_time' => $order_date_time,
                'is_delivered' => $is_delivered,
                'discount_price' => $discount_price,
                'country' => $form_data['country'],
                'city' => $form_data['city'],
                'zip' => $form_data['zip'],
                'order_address' => $form_data['address'],
                'status' => 'Pending',

            ];

        } else {

            $coupon_price = $form_data['coupon_price'];

            if ($coupon_price == '') {
                $discount_price = $price + $commission_fees;
                $coupon_id = 0;
            } else {


    $coupon=UserCoupon::whereHas('couponDetail',function($query) use($coupon_price){
     $query->where('code',$coupon_price);
   })->with('couponDetail')->where('user_id',auth()->user()->id)->Where('is_active',1)->where('coupon_expiray_date', '>=', date("Y-m-d"))->first();  
            
            
                if (empty($coupon)) {
                   $discount_price = ($price + $commission_fees );
                    $coupon_id = 0;
                } else {

                   $coupon_percentage_amount=  round($price *( $coupon->couponDetail->amount / 100 ));
                   // $coupon_percentage_amount =  round(($price / $coupon->couponDetail->amount) * 100);
                    $discount_price = ($price + $commission_fees ) - $coupon_percentage_amount;
                    $coupon_id = $coupon->id;

                }

            }
          
          
            $order_arr = [
                'customer_id' => $customer_id,
                'price' => $price,
                'commission' => $commission,
                'order_date_time' => $order_date_time,
                'is_delivered' => $is_delivered,
                'coupon_id' => $coupon_id,
                'discount_price' => $discount_price,
                'country' => $form_data['country'],
                'city' => $form_data['city'],
                'zip' => $form_data['zip'],
                'order_address' => $form_data['address'],
                'status' => 'Pending',
            ];


        }

    
        $order = Order::create($order_arr);
        // email for order confirmation
        $mail_data = new \stdClass;
        $mail_data->subject = 'Order has been placed!';
        $mail_data->name = auth()->user()->f_name . '  ' . auth()->user()->l_name;
        $mail_data->sub_total =  $discount_price;
        $mail_data->link = env('APP_URL') . '/profile';
        $mail_data->file = 'new_order';
        $mail_data->email = auth()->user()->email;
        OrderPlacedEmailJob::dispatch($mail_data);

      if( isset($order_arr['coupon_id']) && $order_arr['coupon_id'] !=0){
        UserCoupon::where('id',$coupon_id)->update(['is_active'=>0]);
       }
        
        $order_id = $order->id;
        foreach ($form_data['checkout_product_id'] as $key => $value) {

            $order_id = $order_id;
            $product_id = $value;
            $variant_id = $form_data['checkout_varient_id'][$key];
            $product_price = $form_data['variant_sub_total_hidden_' . $variant_id][0];
            $product_qty = $form_data['quantity_' . $variant_id][0];
            $variant_discount = $form_data['variant_discount_' . $variant_id][0];
            $discount_price = 0;
            if ($variant_discount) {
                $variant_discount_price = $form_data['variant_discount_price_' . $variant_id][0];
                $discount_price = $product_price - $variant_discount_price;
            }
            $orderDetail = [
                'order_id' => $order_id,
                'product_id' => $product_id,
                'product_price' => $product_price,
                'discount_price' => $discount_price,
                'variant_id' => $variant_id,
                'product_qty' => $product_qty
            ];

            OrderDetail::create($orderDetail);
            $product_variant = ProductVariant::find($variant_id);
            $var_quantity = $product_variant->quantity;
            $reduce_qty = $var_quantity - $product_qty;
            ProductVariant::where('id', $variant_id)->update(['quantity' => $reduce_qty]);
        }


        unset($_COOKIE['cart']);
        setcookie('cart', '', time() - 3600, '/');


       
        
//        $mail_data = new \stdClass;
//        $mail_data->subject = 'Order has been placed!';
//        $mail_data->name = auth()->user()->f_name . '  ' . auth()->user()->l_name;
//
//        $mail_data->sub_total = $discount_price;
//        $mail_data->link = env('APP_URL') . '/profile';
//        $mail_data->file = 'new_order';
//        foreach ([auth()->user()->email, 'talha.fayyaz@gmail.com'] as $recipient) {
//            Mail::to($recipient)->send(new DefaultMail($mail_data));
//        }

        return redirect('order_confirm');
    }


    public function saveAddress(Request $request)
    {
        try {
            $form_data = $request->all();
            $data_arr = [
                'customer_id' => auth()->user()->id,
                'address' => $form_data['address'],
                'city' => $form_data['city'],
                'zip' => $form_data['zip'],
                'country' => $form_data['country'],
                'status' => 'Inactive'
            ];
            
           
               Address::create($data_arr);
            $adddress = Address::where('customer_id', auth()->user()->id)->get();
            $returnHTML = view('front.address_ajax')->with('adddress', $adddress)->render();

           
         
            return response()->json(['status' => 200, 'message' => 'Address Addedd Successfully', 'html' => $returnHTML]);
            } catch (\Exception $exception) {
                return response()->json(['status' => 422, 'message' => $exception->getMessage()]);
            }
    }

    public function changeAddressStatus($id, $status)
    {
     try {
        Address::where('customer_id', auth()->user()->id)->update(['status' => 'Inactive']);

        if ($status == 'Active') {
            $status = 'Inactive';
        } else {
            $status = 'Active';
        }

        Address::where('id', $id)->update(['status' => $status]);
        
        $adddress = Address::where('customer_id', auth()->user()->id)->get();
        $returnHTML = view('front.address_ajax')->with('adddress', $adddress)->render();
   
         
            return response()->json(['status' => 200, 'message' => 'Address Status has been changed successfully', 'html' => $returnHTML]);

    } catch (\Exception $exception) {
                return response()->json(['status' => 422, 'message' => $exception->getMessage()]);
            }
    
    }

    public function orderDetail($id, $status)
    {
        $order_meta = OrderDetail::where('order_id', $id)->get();

        return view('front.order_detail', compact('order_meta', 'status'));

    }

    public function saveRating(Request $request, $priduct_id, $variant_id)
    {

        $order_arr = [
            'customer_id' => auth()->user()->id,
            'product_id' => $priduct_id,
            'variant_id' => $variant_id,
            'rating' => $request->star_rating,
            'remarks' => $request->remarks,
            'status' => 'Pending',
        ];

        ProductReview::create($order_arr);
    }

}
