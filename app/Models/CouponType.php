<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponType extends Model
{
    protected $table = 'coupon_types';
    use HasFactory;
    protected $fillable = ['name','is_active'];
}
