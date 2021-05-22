<?php

use Illuminate\Support\Facades\Route;
use App\Services\Administrative\IndonesiaService;

Route::prefix('indonesia')->group(function () {
       Route::prefix('provinces')->group(function () {
              Route::get('/', function (IndonesiaService $indonesia) {
                     return $indonesia->allProvinces();
              });
              Route::get('/{province}', function ($province, IndonesiaService $indonesia) {
                     return $indonesia->findProvince($province, ['cities', 'districts.villages']);
              });
       });
       Route::prefix('cities')->group(function () {
              Route::get('/', function (IndonesiaService $indonesia) {
                     return $indonesia->allCities();
              });
              Route::get('/{city}', function ($city, IndonesiaService $indonesia) {
                     return $indonesia->findCity($city, ['districts.villages']);
              });
       });
       Route::prefix('districts')->group(function () {
              Route::get('/', function (IndonesiaService $indonesia) {
                     return $indonesia->allDistricts();
              });
              Route::get('/{district}', function ($ditrict, IndonesiaService $indonesia) {
                     return $indonesia->findDistrict($ditrict, ['villages']);
              });
       });
       Route::prefix('villages')->group(function () {
              Route::get('/', function (IndonesiaService $indonesia) {
                     return $indonesia->allVillages();
              });
              Route::get('/{village}', function ($village, IndonesiaService $indonesia) {
                     return $indonesia->findVillage($village, []);
              });
       });
});
