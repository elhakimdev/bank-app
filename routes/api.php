<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Resources\RoleController;
use App\Http\Controllers\API\Resources\UserController;
use App\Http\Controllers\API\Resources\PermissionController;
use App\Http\Controllers\API\Actions\Roles\RoleActionController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('resources')->group(function () {
    Route::resource('/policy/permissions',  PermissionController::class);
    Route::resource('/policy/roles',        RoleController::class);
    Route::resource('/users',               UserController::class);
    Route::prefix('actions')->group(function () {
        Route::post('role/assign-user/{user}/role/{role}', [RoleActionController::class, 'assignUser'])->name('assign.user.to.given.role');
        Route::post('role/remove-user/{user}/role/{role}', [RoleActionController::class, 'removeUser'])->name('remove.user.to.given.role');
        Route::post('role/assign-permission');
    });
});