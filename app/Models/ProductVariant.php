<?php

namespace App\Models;

use BinaryCats\Sku\HasSku;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariant extends Model
{
    use HasFactory, SoftDeletes, HasSku;
    protected $fillable = ['account_id','product_id','color_id','size_id','length','width',
        'height','weight','is_discounted','discount_price','is_new_arrival',
        'quantity','alert_quantity','discount_valid_till','is_featured','sku'];
    protected $with=['image','variantSize','wishlistItems'];

    public function image(){
        return $this->morphMany( Image::class,'model');
    }

    public function color(){
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function variantSize(){
        return $this->hasMany(ProductColorSize::class,'variant_id');
    }

    public function wishlistItems(){

        return $this->hasMany(WishListItems::class,'variant_id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function setSkuAttribute($value)
    {
        $this->attributes['sku'] = strtolower($value);
    }
}
