<?php

namespace App\Models;

use BinaryCats\Sku\HasSku;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasSku;
    protected $fillable = ['name','category_id','first_child_category'
        ,'second_child_category','is_active','sku','description'];

    protected $with=['variants'];


    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function firstChildCategory(){
            return $this->belongsTo(Category::class,'first_child_category');
    }
    public function secondChildCategory(){
        return $this->belongsTo(Category::class,'second_child_category');
    }

    public function setSkuAttribute($value)
    {
        $this->attributes['sku'] = strtolower($value);
    }

    public function variants(){
        return $this->hasMany(ProductVariant::class, 'product_id');
    }
    public function size(){
        return $this->hasMany(ProductColorSize::class,'product_id');
    }

}
