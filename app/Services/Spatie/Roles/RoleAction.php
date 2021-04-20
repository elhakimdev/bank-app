<?php

namespace App\Services\Spatie\Roles;

use App\Traits\ApiResponser;
use App\Services\Spatie\Config;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Spatie\Roles\RoleService;

class RoleAction extends RoleService
{
       use ApiResponser;
       public object $spatie;

       /**
        * Role Action Service constructor
        *
        * @param RoleService $service
        */
       public function __construct(RoleService $service)
       {
              $this->spatie = $service;
       }

       /**
        * Prepare Action Instance to pass into Action handler
        *
        * @param object $model
        * @param object $role
        * @return object
        */
       public function prepare(object $model, object $role): object
       {
              return $this->spatie->model($model)->role($role);
       }

       /**
        * Handler assign user to role prosess
        *
        * @param object $model
        * @param object $role
        * @return \Illuminate\Http\JsonResponse
        */
       public function handleAssignUser(object $model, object $role): JsonResponse
       {
              return $this->success($this->prepare($model, $role)->handler(Config::ASSIGN_USER), "succes asssign this user for given role", Response::HTTP_CREATED);
       }

       /**
        * Handler remove user to role prosess
        *
        * @param object $model
        * @param object $role
        * @return \Illuminate\Http\JsonResponse
        */
       public function handleRemoveUser(object $model, object $role): JsonResponse
       {
              return $this->success($this->prepare($model, $role)->handler(Config::REMOVE_USER), "succes remove this user for given role", Response::HTTP_OK);
       }

       /**
        * Handler synchronize user for this role
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
