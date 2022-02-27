<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'coupons';
    protected  $fillable = ['account_id','code','type','amount',
        'minimum_amount','quantity','expired_date','user_id','is_active'];

    public function coupon_type(){
        return $this->belongsTo(CouponType::class,'type');
    }

    public function assignedCustomers(){
        return $this->hasMany(UserCoupon::class,'coupon_id');
    }
}
