<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopOtherrole extends Model
{
    use HasFactory;
    protected $table = 'shop_other_role';
    protected $fillable = [
        'shop_other_id',
        'clientele_role',
        'dormitory_role',
        'shop_pr_role'
    ];
}
