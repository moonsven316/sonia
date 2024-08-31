<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopTransportrole extends Model
{
    use HasFactory;
    protected $table = 'shop_transport_role';
    protected $fillable = [
        'shop_transport_id',
        'expense_role',
        'scope_role',
        'time_day_role'
    ];
}
