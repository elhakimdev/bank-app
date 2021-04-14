<?php

use App\Http\Controllers\API\Resources\PermissionController;
use App\Http\Controllers\API\Resources\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('resources')->group(function () {
    Route::resource('/policy/permissions', PermissionController::class);
    Route::resource('/policy/roles',       RoleController::class);
});
