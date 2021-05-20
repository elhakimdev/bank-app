<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table    = 'persons';
    protected $fillable = ['user_id', 'firstname', 'lastname', 'address', 'phone'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
