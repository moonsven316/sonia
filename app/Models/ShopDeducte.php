<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopDeducte extends Model
{
    use HasFactory;
    protected $table = 'shop_deductes';
    protected $fillable = [
        'shop_id',
        'income_tax',
        'welfare_expense',
        'cost_hair',
        'costume_rental_fee'
    ];
}
