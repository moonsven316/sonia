<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    use HasFactory;
    protected $table = 'phone_numbers';
    protected $fillable = [
        'prefecture_id',
        'shop_name',
        'representative',
        'phonenumber'
    ];
}
