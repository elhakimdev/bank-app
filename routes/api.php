<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Resources\RoleController;
use App\Http\Controllers\API\Resources\UserController;
use App\Http\Controllers\API\Resources\PermissionController;
use App\Http\Controllers\API\Actions\Roles\RoleActionController;
use App\Http\Controllers\API\Actions\Permissions\PermissionActionController;
use App\Http\Controllers\Api\Resources\ProfileController;
use App\Services\Administrative\IndonesiaService;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/indonesia/provinces', function (IndonesiaService $indonesia) {
    return $indonesia->allProvinces();
});
Route::get('/indonesia/cities', function (IndonesiaService $indonesia) {
    return $indonesia->allCities();
});
Route::get('/indonesia/districts', function (IndonesiaService $indonesia) {
    return $indonesia->allDistricts();
});
Route::get('/indonesia/villages', function (IndonesiaService $indonesia) {
    return $indonesia->allVillages();
});
Route::prefix('resources')->group(function () {
    Route::resource('/policy/permissions',  PermissionController::class);
    Route::resource('/policy/roles',        RoleController::class);
    Route::resource('/users',               UserController::class);
    Route::resource('/profiles',            ProfileController::class);
    Route::prefix('actions')->group(function () {
        Route::post('role/assign-user/{user}/role/{role}',                      [RoleActionController::class, 'assignUser'])->name('role.assign.user');
        Route::post('role/remove-user/{user}/role/{role}',                      [RoleActionController::class, 'removeUser'])->name('role.remove.user');
        Route::post('permission/assign-user/{user}/permission/{permission}',    [PermissionActionController::class, 'assignDirectPermission'])->name('permission.assign.user');
        Route::post('permission/remove-user/{user}/permission/{permission}',    [PermissionActionController::class, 'removeDirectPermission'])->name('permission.remove.user');
        Route::post('permission/assign-role/{role}/permission/{permission}',    [PermissionActionController::class, 'assignRolePermission'])->name('permission.assign.role');
        Route::post('permission/remove-role/{role}/permission/{permission}',    [PermissionActionController::class, 'removeRolePermission'])->name('permission.remove.role');
    });
});
