<?php

namespace App\Services\Administrative;

use App\Models\Address\City;
use App\Models\Address\District;
use App\Models\Address\Province;
use App\Models\Address\Village;
use Illuminate\Support\Collection;

class IndonesiaService extends BaseService implements IndonesiaServiceInterface
{
       public function all(): Collection
       {
              $result = collect([]);
              if ($this->search) {
                     $provinces    = Province::search($this->search)->get();
                     $city         = City::search($this->search)->get();
                     $ditricts     = District::search($this->search)->get();
                     $villages     = Village::search($this->search)->get();
                     $result->push($provinces);
                     $result->push($city);
                     $result->push($ditricts);
                     $result->push($villages);
              }
              return $result->collapse();
       }
       public function allProvinces(): object
       {
              if ($this->search) {
                     return Province::search($this->search)->get();
              }
              return Province::all();
       }
       public function paginateProvinces(int $numRows = 15): object
       {
              if ($this->search) {
                     return Province::search($this->search)->paginate();
              }
              return Province::paginate($numRows);
       }
       public function allCities(): object
       {
              if ($this->search) {
                     return City::search($this->search)->get();
              }
              return City::all();
       }
       public function paginateCities(int $numRows = 15): object
       {
              if ($this->search) {
                     return City::search($this->search)->paginate();
              }
              return City::paginate($numRows);
       }
       public function allDistricts(): object
       {
              if ($this->search) {
                     return District::search($this->search)->get();
              }
              return District::all();
       }
       public function paginateDistricts(int $numRows = 15): object
       {
              if ($this->search) {
                     return District::search($this->search)->paginate();
              }
              return District::paginate($numRows);
       }
       public function allVillages(): object
       {
              if ($this->search) {
                     return Village::search($this->search)->get();
              }
              return Village::all();
       }
       public function paginateVillages(int $numRows = 15): object
       {
              if ($this->search) {
                     return Village::search($this->search)->paginate();
              }
              return Village::paginate($numRows);
       }
       public function findProvince(int $provinceId, ?array $with = null): object
       {
              // $a = Province::find($provinceId);
              // return $a->load('cities');
              $with = (array) $with;
              if ($with) {
                     $withVillages = array_search('villages', $with);
                     if ($withVillages !== false) {
                            unset($with[$withVillages]);
                            $province = Province::with($with)->find($provinceId);
                            $province->load('cities.districts.villages');
                     } else {
                            $province = Province::with($with)->find($provinceId);
                     }
                     return $province;
              }
              return Province::find($provinceId);
       }
       public function findCity(int $cityId, ?array $with = null): object
       {
              $with = (array) $with;
              if ($with) {
                     return City::with($with)->find($cityId);
              }
              return City::find($cityId);
       }
       public function findDistrict(int $districtId, ?array $with = null): object
       {
              $with = (array) $with;
              if ($with) {
                     $withProvince = array_search('province', $with);
                     if ($withProvince !== false) {
                            unset($with[$withProvince]);
                            $district = District::with($with)->find($districtId);
                            $district->load('city.provinces');
                     } else {
                            $district = District::with($with)->find($districtId);
                     }
                     return $district;
              }
              return District::find($districtId);
       }
       public function findVillage(int $villageId, ?array $with = null): object
       {
              $with = (array) $with;
              if ($with) {
                     $withCity     = array_search('city', $with);
                     $withProvince = array_search('province', $with);
                     if ($withCity !== false && $withProvince !== false) {
                            unset($with[$withCity]);
                            unset($with[$withProvince]);

                            $village = Village::with($with)->find($villageId);
                            $village->load(['district.city', 'district.city.province']);
                     } elseif ($withCity !== false) {
                            unset($with[$withCity]);

                            $village = Village::with($with)->find($villageId);
                            $village->load(['district.city']);
                     } elseif ($withProvince !== false) {
                            unset($with[$withProvince]);

                            $village = Village::with($with)->find($villageId);
                            $village->load(['district.city.province']);
                     }
                     return $village;
              }
              return Village::find($villageId);
       }
       
}
