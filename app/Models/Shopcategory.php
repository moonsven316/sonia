<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopcategory extends Model
{
    use HasFactory;
    protected $table = 'shop_categories';
    protected $fillable = [
        'name',
    ];
}
