<?php

namespace App\Http\Controllers\API\Actions\Permissions;

use App\Http\Controllers\Controller;
use App\Models\Authorization\Permission;
use App\Models\User;
use App\Services\Spatie\Permissions\PermissionAction;
class PermissionActionController extends Controller
{
    public object $permission;
    public function __construct(PermissionAction $action)
    {
        $this->permission = $action;
    }
    public function assignDirectPermission(User $user, Permission $permission)
    {
        return $this->permission->handleAssignDirectPermission($user, $permission);
    }
    public function removeDirectPermission(User $user, Permission $permission)
    {
        return $this->permission->handleRemoveDirectPermission($user, $permission);
    }
    public function assignSyncPermission(User $user, Permission $permission)
    {
        return $this->permission->handleSyncDirectPermission($user, $permission);
    }
}
