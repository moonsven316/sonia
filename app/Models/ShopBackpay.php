<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopBackpay extends Model
{
    use HasFactory;
    protected $table = 'shop_back_paies';
    protected $fillable = [
        'shop_id',
        'honin_back',
        'accompanying_customers',
        'on_site_back',
        'drink_back',
        'bottle_champagene_back',
        'cost_bottle'
    ];
}
