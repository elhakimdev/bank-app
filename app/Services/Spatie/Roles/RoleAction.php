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
       public $spatie;
       public function __construct(RoleService $service)
       {
              $this->spatie = $service;
       }
       public function handleAssignUser(object $model, object $role): JsonResponse
       {
              return $this->success($this->prepare($model, $role)->handler(Config::ASSIGN_USER), "succes asssign this user for given role", Response::HTTP_CREATED);
       }
       public function handleRemoveUser(object $model, object $role): JsonResponse
       {
              return $this->success($this->prepare($model, $role)->handler(Config::REMOVE_USER), "succes remove this user for given role", Response::HTTP_OK);
       }
       public function handleSyncUser(object $model, object $role): JsonResponse
       {
              return $this->success($this->prepare($model, $role)->handler(Config::SYNCHRONIZE_USER), "Succes Sync User", Response::HTTP_OK);
       }
}
