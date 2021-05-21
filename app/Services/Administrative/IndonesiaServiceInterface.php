<?php

namespace  App\Services\Administrative;

interface IndonesiaServiceInterface
{
       public function all();
       public function allProvinces();
       public function paginateProvinces(int $numRows = 15);
       public function allCities();
       public function paginateCities(int $numRows = 15);
       public function allDistricts();
       public function paginateDistricts(int $numRows = 15);
       public function allVillages();
       public function paginateVillages(int $numRows = 15);
       public function findProvince(int $provinceId, array $with = null);
       public function findCity(int $cityId, array $with = null);
       public function findDistrict(int $disrictId, array $with = null);
       public function findVillage(int $villageId, array $with = null);
       // public function loadRelation($object, $relation, $belongsTo = false);
}
