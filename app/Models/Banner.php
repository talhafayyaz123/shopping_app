<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['name','type','order','status'];
    protected $with = ['image'];
    public function image(){
        return $this->morphMany( Image::class,'model');
    }

}
