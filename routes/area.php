<?php

use App\Models\Address\Province;
use Illuminate\Support\Facades\Route;
use App\Services\Administrative\IndonesiaService;
use Illuminate\Http\Request;

Route::prefix('indonesia')->group(function () {
       Route::prefix('provinces')->group(function () {
              // return $request->fullUrl();
              Route::get('/search', function (Request $request) {
                     $qs = $request->fullUrl();
                     $qs = explode('?', $qs);
                     $qs = $qs[1];
                     $param = explode('=', $qs);
                     $indonesia = new IndonesiaService();
                     return $indonesia->search($param[1])->allProvinces();
                     // return $param[1];
              });
              Route::get('/', function (IndonesiaService $indonesia) {
                     return $indonesia->paginateProvinces();
              });
              Route::get('/{province}', function ($province, IndonesiaService $indonesia) {
                     return $indonesia->findProvince($province, ['cities', 'districts.villages']);
              });
       });
       Route::prefix('cities')->group(function () {
              Route::get('/', function (IndonesiaService $indonesia) {
                     return $indonesia->paginateCities();
              });
              Route::get('/{city}', function ($city, IndonesiaService $indonesia) {
                     return $indonesia->findCity($city, ['districts.villages']);
              });
       });
       Route::prefix('districts')->group(function () {
              Route::get('/', function (IndonesiaService $indonesia) {
                     return $indonesia->paginateDistricts();
              });
              Route::get('/{district}', function ($ditrict, IndonesiaService $indonesia) {
                     return $indonesia->findDistrict($ditrict, ['villages']);
              });
       });
       Route::prefix('villages')->group(function () {
              Route::get('/', function (IndonesiaService $indonesia) {
                     return $indonesia->paginateVillages();
              });
              Route::get('/{village}', function ($village, IndonesiaService $indonesia) {
                     return $indonesia->findVillage($village, []);
              });
       });
});
