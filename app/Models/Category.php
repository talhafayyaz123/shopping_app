<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['parent_id','level','category_order','name','slug',
        'short_description','created_by','update_by','is_active'];

//    protected $with = ["childCategory"];

    public function parentCategory(){
        return $this->belongsTo(Category::class,'parent_id');
    }

    public function childCategory(){
        return $this->hasMany(Category::class,'parent_id');
    }

    public function getCreatedByAttribute($value){
        return User::find($value)->f_name;
    }

    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function image(){
        return $this->morphMany( Image::class,'model');
    }

    public function products(){
        return $this->hasMany(Product::class,'category_id');
    }
    public function childCatProducts(){
        return $this->hasMany(Product::class,'first_child_category');
    }
}
