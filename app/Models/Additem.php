<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Additem extends Model
{
    use HasFactory;
    protected $table = 'add_items';
    protected $fillable = [
        'shop_id',
        'add_item_label',
        'add_item_content',
        'add_item_role',
    ];
    
}
