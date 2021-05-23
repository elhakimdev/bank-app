<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\Administrative\IndonesiaService;
use App\Http\Controllers\API\Actions\Address\SetProfileAddressController;
use App\Models\ProfileAddress;

Route::get('profileaddress/{id}', function ($id) {
       return ProfileAddress::find($id);
});
Route::post('profile/address/create/area', SetProfileAddressController::class);
Route::prefix('indonesia')->group(function () {
       Route::prefix('provinces')->group(function () {
              Route::get('/search', function (Request $request) {
                     $qs = $request->fullUrl();
                     $qs = explode('?', $qs);
                     $qs = $qs[1];
                     $param = explode('=', $qs);
                     $indonesia = new IndonesiaService();
                     return $indonesia->search($param[1])->allProvinces();
              });
              Route::get('/', function (IndonesiaService $indonesia) {
                     return $indonesia->allProvinces();
              });
              Route::get('/{province}', function ($province, IndonesiaService $indonesia) {
                     return $indonesia->findProvince($province, ['cities', 'districts.villages']);
              });
       });
       Route::prefix('cities')->group(function () {
              Route::get('/search', function (Request $request) {
                     $qs           = $request->fullUrl();
                     $qs           = explode('?', $qs);
                     $qs           = $qs[1];
                     $param        = explode('=', $qs);
                     $indonesia    = new IndonesiaService();
                     return $indonesia->search($param[1])->allCities();
              });
              Route::get('/', function (IndonesiaService $indonesia) {
                     return $indonesia->allCities();
              });
              Route::get('/{city}', function ($city, IndonesiaService $indonesia) {
                     return $indonesia->findCity($city, ['districts.villages']);
              });
       });
       Route::prefix('districts')->group(function () {
              Route::get('/search', function (Request $request) {
                     $qs           = $request->fullUrl();
                     $qs           = explode('?', $qs);
                     $qs           = $qs[1];
                     $param        = explode('=', $qs);
                     $indonesia    = new IndonesiaService();
                     return $indonesia->search($param[1])->allDistricts();
              });
              Route::get('/', function (IndonesiaService $indonesia) {
                     return $indonesia->allDistricts();
              });
              Route::get('/{district}', function ($ditrict, IndonesiaService $indonesia) {
                     return $indonesia->findDistrict($ditrict, ['villages']);
              });
       });
       Route::prefix('villages')->group(function () {
              Route::get('/search', function (Request $request) {
                     $qs           = $request->fullUrl();
                     $qs           = explode('?', $qs);
                     $qs           = $qs[1];
                     $param        = explode('=', $qs);
                     $indonesia    = new IndonesiaService();
                     return $indonesia->search($param[1])->allVillages();
              });
              Route::get('/', function (IndonesiaService $indonesia) {
                     return $indonesia->allVillages();
              });
              Route::get('/{village}', function ($village, IndonesiaService $indonesia) {
                     return $indonesia->findVillage($village, []);
              });
       });
});
