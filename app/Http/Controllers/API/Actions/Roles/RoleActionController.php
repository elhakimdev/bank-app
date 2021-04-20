<?php

namespace App\Http\Controllers\API\Actions\Roles;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Models\Authorization\Role;
use App\Http\Controllers\Controller;
use App\Services\Spatie\Roles\RoleAction;

class RoleActionController extends Controller
{
    public object $role;
    public function __construct(RoleAction $action)
    {
        $this->role = $action;
    }
    public function assignUser(User $user, Role $role): JsonResponse
    {
        return $this->role->handleAssignUser($user, $role);
    }
    public function removeUser(User $user, Role $role): JsonResponse
    {
        return $this->role->handleRemoveUser($user, $role);
    }
    public function syncUser(User $user, Role $role): JsonResponse
    {
        return $this->role->handleSyncUser($user, $role);
    }
}
