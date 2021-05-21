<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends District
{
    use HasFactory;
    protected $table                = 'districts';
    protected $guarded              = [];
    protected $searchableColumns    = [
        'code',
        'name',
        'kabupaten.name'
    ];
    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'city_code');
    }
    public function getAddressAttribute()
    {
        return sprintf(
            '%s,%s,%s,Indonesia',
            $this->name,
            $this->kabupaten->name,
            $this->kabupaten->provinsi->name
        );
    }
}
