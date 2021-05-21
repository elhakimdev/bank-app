<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends \App\Models\Address\Base
{
    use HasFactory;
    protected $table = 'provinces';
    protected $casts = [
        'meta' => 'array',
    ];
    public function cities()
    {
        return $this->hasMany(City::class, 'province_code');
    }
    public function districts()
    {
        return $this->hasManyThrough(District::class, City::class, 'province_code', 'city_code');
    }
}
