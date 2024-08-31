<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrefectureRegion extends Model
{
    use HasFactory;
    protected $table = 'tbl_prefecture_region';
    protected $fillable = [
        'name',
        'en_name',
        'main_id',
    ];
    
    public function shops(){
        return $this->hasMany(Shop::class, 'prefecture_id', 'id');
    }
    public function phone(){
        return $this->hasMany(PhoneNumber::class, 'prefecture_id', 'id');
    }
    public function areas() {
        return $this->hasMany(CityRegion::class, 'prefecture_id', 'id');
    }
}
