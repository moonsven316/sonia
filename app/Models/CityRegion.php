<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityRegion extends Model
{
    use HasFactory;
    protected $table = 'tbl_city_region';
    protected $fillable = [
        'name',
        'en_name',
        'prefecture_id',
    ];

    public function shops(){
        return $this->hasMany(Shop::class, 'area_id', 'id');
    }
}
