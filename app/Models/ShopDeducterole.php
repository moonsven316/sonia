<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopDeducterole extends Model
{
    use HasFactory;
    protected $table = 'shop_deducte_roles';
    protected $fillable = [
        'shop_deducte_id',
        'income_tax_role',
        'welfare_expense_role',
        'cost_hair_role',
        'costume_rental_fee_role'
    ];
}
