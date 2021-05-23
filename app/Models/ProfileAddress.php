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
     * Convert the attributes into an array 
     *
     * @return array
     */
    protected function explodedAddresAtribute(): array
    {
        return $this->addressDetailAttribute = explode(",", $this->address_detail);
    }

    /**
     * Split an array into new array of each index exploded address by double ":"
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

    public function getProvinceAttribute(): string
    {
        return $this->attributeIndex(3);
    }
    public function getCityAttribute(): string
    {
        return $this->attributeIndex(2);
    }
    public function getDistrictAttribute(): string
    {
        return $this->attributeIndex(1);
    }
    public function getVillageAttribute(): string
    {
        return $this->attributeIndex(0);
    }
    public function getCountryAttribute(): string
    {
        return $this->attributeIndex(4);
    }
}
