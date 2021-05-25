<?php

namespace App\Services\Spatie\Permissions;

use App\Models\User;

interface PermissionServiceInterface
{
       public function permission(object $permission): self;
       public function getPermission(object $permission): self;
       public function model(object $model): self;
       public function handler(string $method, object $model, object $permission): User;
       public function prepare(object $model, object $permission): self;
}
