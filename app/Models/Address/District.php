<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends \App\Models\Address\Base
{
    use HasFactory;
    protected $table = 'districts';
    protected $casts = [
        'meta' => 'array',
    ];
    public function city()
    {
        return $this->belongsTo(City::class, 'city_code', 'code');
    }
    public function Villages()
    {
        return $this->hasMany(Village::class, 'district_code', 'code');
    }
    public function getCityNameAttribute()
    {
        return $this->city->name;
    }
    public function getProvinceNameAttribute()
    {
        return $this->city->province->name;
    }
}
