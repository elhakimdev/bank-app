<?php

namespace App\Http\Controllers\API\Actions\Roles;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Models\Authorization\Role;
use App\Http\Controllers\Controller;
use App\Services\Spatie\Roles\RoleAction;

class RoleActionController extends Controller
{
    public function __construct(RoleAction $action)
    {
        $this->action = $action;
    }
    /**
     * assign user to given role
     *
     * @param User $user
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignUser(User $user, Role $role): JsonResponse
    {
        return $this->action->handleAssignUser($user, $role);
    }
    /**
     * remove assigned user on this role
     *
     * @param User $user
     * @param Role $role
     * @return  \Illuminate\Http\JsonResponse
     */
    public function removeUser(User $user, Role $role): JsonResponse
    {
        return $this->action->handleRemoveUser($user, $role);
    }
    /**
     * syncrhonize role for this user
     * 
     *
     * @param User $user
     * @param Role $role
     * @return JsonResponse
     */
    public function syncUser(User $user, Role $role): JsonResponse
    {
        return $this->success($this->prepare($user, $role)->handler('sync-user'));
    }
}
