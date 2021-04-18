<?php

namespace App\Services\Spatie\Roles;

interface RoleServiceInterface
{
       public function handler(string $method, object $model, object $role);
}
