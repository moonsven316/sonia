<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopOther extends Model
{
    use HasFactory;
    protected $table = 'shop_others';
    protected $fillable = [
        'shop_id',
        'clientele',
        'dormitory',
        'shop_pr'
    ];
}
