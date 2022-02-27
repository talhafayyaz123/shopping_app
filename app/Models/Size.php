<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $fillable = ['name','type','is_active'];

    public function sizeVarientDetail(){
        return $this->belongsTo(ProductColorSize::class, 'size_id');
    }
}
