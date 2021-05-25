<?php

namespace App\Services\Spatie\Roles;

use App\Models\User;

/**
 * -------------------------------------
 * Interface Role Service
 * -------------------------------------
 * Abstract structure for spatie role service class
 * 
 * @author ElhakimDev <abdulelhakim68@gmail.com>
 * @version 1.0.0
 */
interface RoleServiceInterface
{
       public function role(object $permission): self;
       public function getRole(object $permission): self;
       public function model(object $model): self;
       public function handler(string $method, object $model, object $permission): User;
       public function prepare(object $model, object $permission): self;
}
