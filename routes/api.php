<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Resources\RoleController;
use App\Http\Controllers\API\Resources\UserController;
use App\Http\Controllers\API\Resources\PermissionController;
use App\Http\Controllers\API\Actions\Roles\RoleActionController;
use App\Http\Controllers\API\Actions\Permissions\PermissionActionController;
use App\Http\Controllers\Api\Resources\ProfileController;
use App\Http\Controllers\AuthTokenController;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use App\Traits\ApiResponser;
use Illuminate\Auth\AuthenticationException;

Route::get('/user', function (Request $request) {
    return Auth::user();
})->middleware('auth:sanctum');
Route::get('/log', function (Request $request) {
    return Activity::all();
})->middleware('auth:sanctum');
/**
 * -----------------------------------------------------------------------------
 * Routes For Authentication Using Token / Bearer 
 * -----------------------------------------------------------------------------
 */
Route::post('auth/token/register',  [AuthTokenController::class, 'register'])->name('auth.token.register');
Route::post('auth/token/login',     [AuthTokenController::class, 'login'])->name('auth.token.login');
Route::post('auth/token/logout',    [AuthTokenController::class, 'logout'])->name('auth.token.logout')->middleware('auth:sanctum');
/**
 * -----------------------------------------------------------------------------
 * Routes For CRUD RESOURCES
 * -----------------------------------------------------------------------------
 */
Route::prefix('resources')->middleware('auth:sanctum')->group(function () {
    Route::resource('/policy/permissions',  PermissionController::class);
    Route::resource('/policy/roles',        RoleController::class);
    Route::resource('/users',               UserController::class);
    Route::resource('/profiles',            ProfileController::class);
    /**
     * -----------------------------------------------------------------------------
     * Routes For CRUD ACTIONS
     * -----------------------------------------------------------------------------
     */
    Route::prefix('actions')->group(function () {
        Route::post('role/assign-user/{user}/role/{role}',                      [RoleActionController::class, 'assignUser'])->name('role.assign.user');
        Route::post('role/remove-user/{user}/role/{role}',                      [RoleActionController::class, 'removeUser'])->name('role.remove.user');
        Route::post('permission/assign-user/{user}/permission/{permission}',    [PermissionActionController::class, 'assignDirectPermission'])->name('permission.assign.user');
        Route::post('permission/remove-user/{user}/permission/{permission}',    [PermissionActionController::class, 'removeDirectPermission'])->name('permission.remove.user');
        Route::post('permission/assign-role/{role}/permission/{permission}',    [PermissionActionController::class, 'assignRolePermission'])->name('permission.assign.role');
        Route::post('permission/remove-role/{role}/permission/{permission}',    [PermissionActionController::class, 'removeRolePermission'])->name('permission.remove.role');
    });
});
