<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'gender',
        'address',
        'phone_number'
    ];
    protected $appends = ['Fullname', 'Fulladdress'];
    public function getFullnameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');   
    }
    public function profileAddress()
    {
        return $this->hasOne(ProfileAddress::class, 'profile_id');
    }
    public function getFulladdressAttribute()
    {
        if (is_null($this->profileAddress)) {
            return "";
        }
        return $this->profileAddress['address_detail'];
    }
}
