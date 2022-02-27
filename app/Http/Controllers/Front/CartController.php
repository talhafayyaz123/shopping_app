<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cookie;
use App\Models\UserCoupon;

class CartController extends Controller
{


  public function clearCart()
   {
     unset($_COOKIE['cart']);
    setcookie('cart', '', time() - 3600, '/');
    return redirect('cart')->with('success', 'Cart Has Been Cleared.');
   }

   public function orderConfirm()
   {
     
      return view('front.order_confirm');
   }

   function checkCouponValidity($coupon_code){
   
   $is_coupon_active_expire=0;
   $user_coupon=UserCoupon::whereHas('couponDetail',function($query) use($coupon_code){
     $query->where('code',$coupon_code);
   })->where('user_id',auth()->user()->id)->Where('is_active',1)->where('coupon_expiray_date', '>=', date("Y-m-d"))->get();      
  
   if($user_coupon->count()==0 ){
    $is_coupon_active_expire=1;
   }


  $is_used=0;
  $used_coupon=UserCoupon::whereHas('couponDetail',function($query) use($coupon_code){
     $query->where('code',$coupon_code);
   })->whereHas('order',function($query2) {
    $query2->where('customer_id',auth()->user()->id);
   })->get(); 


    if($used_coupon->count()>0 ){
    $is_used=1;
   }


   $is_exist=1;
    $user_coupon=UserCoupon::whereHas('couponDetail',function($query) use($coupon_code){
     $query->where('code',$coupon_code);
   })->get();

     if($user_coupon->count()==0 ){
    $is_exist=0;
   }


    if($is_exist==0){
    
    return response()->json(['status' => 422, 'message' =>'Coupon Not Exist.']);
    }else{
   
   if($is_coupon_active_expire==1){
     return response()->json(['status' => 422, 'message' =>'Coupon Not Active Or Expired.']);
   
   }else if($is_used==1){
     return response()->json(['status' => 422, 'message' =>'Coupon Already Used.']);
   
      }else if($is_coupon_active_expire==1 && $is_used==1){

       return response()->json(['status' => 422, 'message' =>'Coupon Already Used Or Expired/Inactive.']);
    

   }else{
 return response()->json(['status' => 200, 'message' =>'Coupon in use.']);
   
   }

    }



   } 

}
