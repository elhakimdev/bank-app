<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class City extends \App\Models\Address\Base
{
    use HasFactory;
    protected $table = 'cities';
    protected $casts = [
        'meta' => 'array',
    ];
    // protected $appends = ['ProvinceName'];
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_code', 'code');
    }
    public function districts()
    {
        return $this->hasMany(District::class, 'city_code', 'code');
    }
    public function villages()
    {
        return $this->hasManyThrough(Village::class, District::class, 'city_code', 'district_code');
    }
    public function getProvinceNameAttribute()
    {
        return $this->province->name;
    }
}   
