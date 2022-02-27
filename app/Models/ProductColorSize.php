<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColorSize extends Model
{
    use HasFactory;
    public function size(){
        return $this->belongsTo(Size::class,'size_id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
