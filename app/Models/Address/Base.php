<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    public $timestamps = false;
    protected $keyType = 'string';
    // protected $searchableColumns = ['code', 'name'];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = $this->table;
    }
    public function scopeSearch($query, string $keyword)
    {
        if ($keyword) {
            $query->where('name', 'like', $keyword . "%");
        }
    }
}
