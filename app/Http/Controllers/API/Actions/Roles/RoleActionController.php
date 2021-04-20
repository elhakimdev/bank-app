<?php

namespace App\Http\Controllers\API\Actions\Roles;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Models\Authorization\Role;
use App\Http\Controllers\Controller;
use App\Services\Spatie\Roles\RoleAction;

class RoleActionController extends Controller
{
    /**
     * Instance new Role Action 
     *
     * @var Object
     */
    public object $role;

    /**
     * Construct this action object
     *
     * @param \App\Services\Spatie\Roles\RoleAction $action
     */
    public function __construct(RoleAction $action)
    {
        $this->role = $action;
    }
    /**
     * assign user to given role
     * 
     *
     * @param \App\Models\User $user
     * @param \App\Models\Authorization\Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignUser(User $user, Role $role): JsonResponse
    {
        // $role = new RoleAction(new RoleService());
        // $role->handleAssignUser()
        return $this->role->handleAssignUser($user, $role);
    }
    /**
     * remove assigned user on this role
     *
     * @param \App\Models\User $user
     * @param \App\Models\Authorization\Role $role
     * @return  \Illuminate\Http\JsonResponse
     */
    public function removeUser(User $user, Role $role): JsonResponse
    {
        return $this->role->handleRemoveUser($user, $role);
    }
    /**
     * syncrhonize role for this user
     * 
     *
     * @param \App\Models\User $user
     * @param \App\Models\Authorization\Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function syncUser(User $user, Role $role): JsonResponse
    {
        return $this->role->handleSyncUser($user, $role);
    }
}
