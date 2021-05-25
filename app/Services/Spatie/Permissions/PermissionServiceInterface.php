<?php

namespace App\Services\Spatie\Permissions;

use App\Models\User;

/**
 * -------------------------------------
 * Interface Permission Service
 * -------------------------------------
 * Abstract structure for spatie permission service class
 * 
 * @author ElhakimDev <abdulelhakim68@gmail.com>
 * @version 1.0.0
 */
interface PermissionServiceInterface
{
       public function permission(object $permission): self;
       public function getPermission(object $permission): self;
       public function model(object $model): self;
       public function handler(string $method, object $model, object $permission): User;
       public function prepare(object $model, object $permission): self;
}
