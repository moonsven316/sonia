<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopTransport extends Model
{
    use HasFactory;
    protected $table = 'shop_transports';
    protected $fillable = [
        'shop_id',
        'expense',
        'scope',
        'time_day'
    ];
}
