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
    public object $permission;
    public function __construct(PermissionAction $action)
    {
        $this->permission = $action;
    }
    public function assignDirectPermission(User $user, Permission $permission): JsonResponse
    {
        return $this->permission->handleAssignDirectPermission($user, $permission);
    }
    public function removeDirectPermission(User $user, Permission $permission): JsonResponse
    {
        return $this->permission->handleRemoveDirectPermission($user, $permission);
    }
    public function assignSyncPermission(User $user, Permission $permission): JsonResponse
    {
        return $this->permission->handleSyncDirectPermission($user, $permission);
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
