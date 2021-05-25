<?php

namespace App\Services\Spatie\Permissions;

interface PermissionServiceInterface
{
       public function permission(object $permission);
       public function getPermission(object $permission);
       public function model(object $model);
       public function handler(string $method, object $model, object $permission);
       public function prepare(object $model, object $permission);
}
