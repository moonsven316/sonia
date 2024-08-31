<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $table = 'shops';
    protected $fillable = [
        'category_id',
        'name',
        'prefecture_id',
        'area_id',
        'address',
        'affiliated_stores',
        'business_time',
        'identification',
        'costume',
        'main_vip',
        'age_shift_week',
        'salary_system'
    ];
}
