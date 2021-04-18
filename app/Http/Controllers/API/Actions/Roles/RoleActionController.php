<?php

namespace App\Http\Controllers\API\Actions\Roles;

use App\Models\User;
use App\Traits\ApiResponser;
use App\Models\Authorization\Role;
use App\Http\Controllers\Controller;
use App\Services\Spatie\Roles\RoleService;

class RoleActionController extends Controller
{
    use ApiResponser;
    public $spatie;
    public function __construct(RoleService $service)
    {
        $this->spatie = $service;
    }
    /**
     * assign user to given role
     *
     * @param User $user
     * @param Role $role
     * @return void
     */
    public function assignUser(User $user, Role $role)
    {
        return $this->spatie->model($user)->role($role)->handler('assign-user');
    }
    /**
     * remove assigned user on this role
     *
     * @param User $user
     * @param Role $role
     * @return void
     */
    public function removeUser(User $user, Role $role)
    {
        return $this->spatie->model($user)->role($role)->handler('remove-user');
    }
}
