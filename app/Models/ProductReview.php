<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;
    protected $table='product_reviews';

    protected $fillable=['customer_id','product_id','variant_id','rating','remarks','status'];
    
    
    function customer()
    {
         return $this->belongsTo(User::class,'customer_id');
    }


   
  /*public function getRatingAttribute($value){
    if($value==1){
        $rating_width='20%';
    }else if($value==2){
         $rating_width='40%';
    }else if($value==3){
         $rating_width='60%';
    }else if($value==4){
         $rating_width='80%';
    }else{
         $rating_width='100%';
    }
    return $rating_width;
  }*/



}
