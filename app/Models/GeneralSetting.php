<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;
    protected $table = 'general_settings';
    protected $fillable= ['account_id','site_title','date_format','currency',
        'products_alert_quantity','sign_up_discount'];
}
