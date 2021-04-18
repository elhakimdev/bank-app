<?php

namespace App\Http\Controllers\API\Actions\Roles;

use App\Models\User;
use App\Traits\ApiResponser;
use App\Models\Authorization\Role;
use App\Http\Controllers\Controller;
use App\Services\Spatie\Roles\RoleService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignUser(User $user, Role $role): JsonResponse
    {
        $action = $this->spatie->model($user)->role($role)->handler('assign-user');
        return $this->success($action, "succes asssign this user for given role", Response::HTTP_CREATED);
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
        $action = $this->spatie->model($user)->role($role)->handler('remove-user');
        return $this->success($action, "succes remove this user for given role", Response::HTTP_OK);
    }
}
