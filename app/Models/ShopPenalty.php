<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopPenalty extends Model
{
    use HasFactory;
    protected $table = 'shop_penalties';
    protected $fillable = [
        'shop_id',
        'quota',
        'tardiness_penalty',
        'begin_n_penalty',
        'show_n_penalty'
    ];
}
