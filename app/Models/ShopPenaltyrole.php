<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopPenaltyrole extends Model
{
    use HasFactory;
    protected $table = 'shop_penalty_role';
    protected $fillable = [
        'shop_penalty_id',
        'quota_role',
        'tardiness_penalty_role',
        'begin_n_penalty_role',
        'show_n_penalty_role'
    ];
}
