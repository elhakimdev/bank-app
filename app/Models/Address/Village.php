<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Village extends \App\Models\Address\Base
{
    use HasFactory;
    protected $table = 'villages';
    protected $casts = [
        'meta' => 'array',
    ];
    // protected $appends = ['DistrictName', 'CityName', 'ProvinceName'];
    public function district()
    {
        return $this->belongsTo(District::class, 'district_code', 'code');
    }
    public function getDistrictNameAttribute()
    {
        return $this->district->name;
    }
    public function getCityNameAttribute()
    {
        return $this->district->city->name;
    }
    public function getProvinceNameAttribute()
    {
        return $this->district->city->province->name;
    }
}
