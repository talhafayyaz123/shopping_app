<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $taable='addresses';
    protected $fillable=['customer_id','address','city','zip','country','status'];
}
