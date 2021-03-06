<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Village
{
    use HasFactory;
    protected $table                = 'villages';
    protected $guarded              = [];
    protected $searchableColumns    = [
        'code',
        'name',
        'kecamatan.name'
    ];
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'district_code');
    }
    public function getAddressAttribute()
    {
        return sprintf(
            '%s,%s,%s,%s,Indonesia',
            $this->name,
            $this->kecamatan->name,
            $this->kecamatan->kabupaten->name,
            $this->kecamatan->kabupaten->provinsi->name
        );
    }
}
