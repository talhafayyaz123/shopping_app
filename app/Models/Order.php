<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['account_id','customer_id','price','commission','discount','coupon_id',
        'order_date_time','is_delivered','discount_price','order_address','city','zip','country','status'];

  public function getOrderDateTimeAttribute($value){
    return date('d,M ,Y', strtotime( $value));
  }


  public function order_detail(){
    return $this->hasMany(OrderDetail::class,'order_id');
  }

  public function customer(){
      return $this->belongsTo(User::class,'customer_id');
  }

}
