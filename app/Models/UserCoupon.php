<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCoupon extends Model
{
    use HasFactory;

    public function couponDetail(){
        return $this->belongsTo(Coupon::class,'coupon_id');
    }

   public function order(){

    return $this->belongsTo(Order::class,'id','coupon_id');
   }
}
