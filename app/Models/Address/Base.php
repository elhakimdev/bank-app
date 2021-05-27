<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Base extends Model
{
    use LogsActivity;
    public $timestamps = false;
    protected $keyType = 'string';
    protected $searchableColumns = ['code', 'name'];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = $this->table;
    }
    public function scopeSearch($query, string $keyword)
    {
        if ($keyword && $this->searchableColumns) {
            $query->whereLike($this->searchableColumns, $keyword);
        }
    }
}
