<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Resources\PermissionController;
use App\Http\Controllers\API\Resources\RoleController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('resources')->group(function () {
    Route::resource('/policy/permissions',  PermissionController::class);
    Route::resource('/policy/roles',        RoleController::class);
    Route::resource('/users',               RoleController::class);
});