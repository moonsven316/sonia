<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopBackpayrole extends Model
{
    use HasFactory;
    protected $table = 'shop_back_pay_roles';
    protected $fillable = [
        'shop_back_id',
        'honin_back_role',
        'accompanying_customers_role',
        'on_site_back_role',
        'drink_back_role',
        'bottle_champagene_back_role',
        'cost_bottle_role'
    ];
}
