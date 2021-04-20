<?php

namespace App\Services\Spatie\Permissions;

interface PermissionServiceInterface
{
       public function handler(string $method, object $model, object $permission);
}
