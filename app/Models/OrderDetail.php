<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table='orders_meta';
     protected $fillable = ['order_id','product_id','product_sku','vendor_id','product_price','discount_price',
        'variant_id','product_qty'];

       protected $with=['product'];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

  public function reviews(){

    if(Auth::check()){
     return $this->belongsTo( ProductReview::class ,'variant_id','variant_id')->where('customer_id',auth()->user()->id);
    }else{
     return $this->belongsTo( ProductReview::class ,'variant_id','variant_id');
    }
    
  }

  public function variant(){
      return $this->belongsTo(ProductVariant::class,'variant_id');
  }

  public function order(){
        return $this->belongsTo(Order::class,'order_id');
  }


}
