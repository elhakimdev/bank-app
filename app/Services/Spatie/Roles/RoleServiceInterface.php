<?php

namespace App\Services\Spatie\Roles;

/**
 * Role Service interface
 */
interface RoleServiceInterface
{
       public function handler(string $method, object $model, object $role);
}
