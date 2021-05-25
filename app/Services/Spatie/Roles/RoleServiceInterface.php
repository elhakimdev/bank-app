<?php

namespace App\Services\Spatie\Roles;

use App\Models\User;

/**
 * Role Service interface
 */
interface RoleServiceInterface
{
       public function role(object $permission): self;
       public function getRole(object $permission): self;
       public function model(object $model): self;
       public function handler(string $method, object $model, object $permission): User;
       public function prepare(object $model, object $permission): self;
}
