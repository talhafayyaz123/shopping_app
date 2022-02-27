<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Guard;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = ['model_id','model_type','image'];


    public function imagable()
    {
        return $this->morphTo();
    }

//    public function getImageAttribute($value)
//    {
//
//        if(Auth::guard('api')->check()){
//            return  url('assets/cutting/').'/'.$value;
//        }else{
//            return  asset('assets/cutting/'.$value);
//        }
//    }

    public function productImage(){
        if(Auth::guard('api')->check()){
            return  url('assets/uploads/products').'/'.$this->image;
        }else{
            return  asset('assets/uploads/products'.$this->image);
        }
    }

}
