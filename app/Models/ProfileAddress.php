<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'profile_id',
        'address_detail',
    ];
    protected $appends = [
        'Province',
        'City',
        'District',
        'Village',
        'Country'
    ];
    /**
     * 
     */
    protected array $addressDetailAttribute;

    /**
     * ProfileAddress Belongs to Profile
     *
     * @return object
     */
    public function profile(): object
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    /**
     * Check is Profie_ID Is Nt Exist on model
     *
     * @param [type] $query
     * @param [type] $request
     * @return void
     */
    public function scopeIsNotExist($query, $request)
    {
        return $query->where('profile_id', $request->profile_id)->doesntExist();
    }
    /**
     * Convert the attributes into an array 
     *
     * @return array
     */
    protected function explodedAddresAtribute(): array
    {
        return $this->addressDetailAttribute = explode(",", $this->address_detail);
    }

    /**
     * Split an array of new arry attribute into new array of each index exploded address by double ":"
     *
     * @param array $attribute
     * @param integer $index
     * @return array
     */
    protected function splitArrayAttribute(array $attribute, int $index): array
    {
        return explode(":", $attribute[$index]);
    }

    /**
     * Get the results value of new indexed array with passing an integer index parameter
     *
     * @param integer $index
     * @return string
     */
    protected function attributeIndex(int $index): string
    {
        if ($index === 4 || $index === 2) {
            return strtoupper(ltrim($this->explodedAddresAtribute()[$index]));
        }
        return ltrim($this->splitArrayAttribute($this->explodedAddresAtribute(), $index)[1]);
    }

    /**
     * Get Province attribute
     *
     * @return string
     */
    public function getProvinceAttribute(): string
    {
        return $this->attributeIndex(3);
    }

    /**
     * Get City attribute
     *
     * @return string
     */
    public function getCityAttribute(): string
    {
        return $this->attributeIndex(2);
    }

    /**
     * Get Distric attribute
     *
     * @return string
     */
    public function getDistrictAttribute(): string
    {
        return $this->attributeIndex(1);
    }

    /**
     * Get Village attribute
     *
     * @return string
     */
    public function getVillageAttribute(): string
    {
        return $this->attributeIndex(0);
    }

    /**
     * Get Country attribute
     *
     * @return string
     */
    public function getCountryAttribute(): string
    {
        return $this->attributeIndex(4);
    }
}
