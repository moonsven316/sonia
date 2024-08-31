<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoprole extends Model
{
    use HasFactory;
    protected $table = 'shop_roles';
    protected $fillable = [
        'shop_id',
        'category_id_role',
        'name_role',
        'prefecture_id_role',
        'area_id_role',
        'address_role',
        'affiliated_stores_role',
        'business_time_role',
        'identification_role',
        'costume_role',
        'main_vip_role',
        'age_shift_week_role',
        'salary_system_role'
    ];
}
