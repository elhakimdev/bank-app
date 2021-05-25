<?php

namespace App\Http\Controllers\API\Actions\Permissions;

use App\Http\Controllers\Controller;
use App\Models\Authorization\Permission;
use App\Models\Authorization\Role;
use App\Models\User;
use App\Services\Spatie\Permissions\PermissionAction;
use Illuminate\Http\JsonResponse;

class PermissionActionController extends Controller
{
    public  $permission;
    public function __construct(PermissionAction $action)
    {
        $this->permission = $action;
    }
    public function assignRolePermission(Role $role, Permission $permission): JsonResponse
    {
        return $this->permission->handleAssignPermission($role, $permission);
    }
    public function removeRolePermission(Role $role, Permission $permission): JsonResponse
    {
        return $this->permission->handleRemovePermission($role, $permission);
    }
}
