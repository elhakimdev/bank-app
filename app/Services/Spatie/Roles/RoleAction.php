<?php

namespace App\Services\Spatie\Roles;

use App\Traits\ApiResponser;
use App\Services\Spatie\Config;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Spatie\Roles\RoleService;

/**
 * -------------------------------------
 * Class RoleAction
 * -------------------------------------
 * Here are implementation of our role service class
 * 
 * You feel free to define new method to handle spatie role operation,
 * just using our already service method that inherit form Role Service class,
 * we are extend Role Service to make the code clean and still on SOLID principle.
 * 
 * @author ElhakimDev <abdulelhakim68@gmail.com>
 * @version 1.0.0
 */
class RoleAction extends RoleService
{
       use ApiResponser;
       /**
        * Handle to assign user for given role
        *
        * @param object $model
        * @param object $role
        * @return JsonResponse
        */
       public function handleAssignUser(object $model, object $role): JsonResponse
       {
              return $this->success($this->prepare($model, $role)->handler(Config::ASSIGN_USER), "succes asssign this user for given role", Response::HTTP_CREATED);
       }
       /**
        * Handle to remove user for given role
        *
        * @param object $model
        * @param object $role
        * @return JsonResponse
        */
       public function handleRemoveUser(object $model, object $role): JsonResponse
       {
              return $this->success($this->prepare($model, $role)->handler(Config::REMOVE_USER), "succes remove this user for given role", Response::HTTP_OK);
       }
       /**
        * Handle to synchronize user to given multiple roles
        *
        * @param object $model
        * @param object $role
        * @return JsonResponse
        */
       public function handleSyncUser(object $model, object $role): JsonResponse
       {
              return $this->success($this->prepare($model, $role)->handler(Config::SYNCHRONIZE_USER), "Succes Sync User", Response::HTTP_OK);
       }
}
