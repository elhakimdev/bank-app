<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends City
{
    use HasFactory;
    protected $table                = 'cities';
    protected $guarded              = [];
    protected $searchableColumns    = [
        'code',
        'name',
        'provinsi.name'
    ];
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'province_code');
    }
    public function getAddressAttribute()
    {
        return sprintf(
            '%s,%s,Indonesia',
            $this->name,
            $this->provinsi->name
        );
    }
}
