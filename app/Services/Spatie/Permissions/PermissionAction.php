<?php

namespace App\Services\Spatie\Permissions;

use App\Services\Spatie\Config;
use App\Services\Spatie\Permissions\PermissionService;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PermissionAction extends PermissionService
{
       use ApiResponser;
       public object $spatie;
       public function __construct(PermissionService $service)
       {
              $this->spatie = $service;
       }
       public function prepare(object $model, object $permission): object
       {
              return $this->spatie->model($model)->permission($permission);
       }
       public function handleAssignDirectPermission(object $model, object $permission): JsonResponse
       {
              return $this->success($this->prepare($model, $permission)->handler(Config::ASSIGN_DIRECT_PERMISSION), "succes asssign this user for given direct permission", Response::HTTP_CREATED);
       }
       public function handleRemoveDirectPermission(object $model, object $permission): JsonResponse
       {
              return $this->success($this->prepare($model, $permission)->handler(Config::REMOVE_DIRECT_PERMISSION), "succes remove this user for given direct permission", Response::HTTP_OK);
       }
       public function handleSyncDirectPermisssion(object $model, object $permission): JsonResponse
       {
              return $this->success($this->prepare($model, $permission)->handler(Config::SYNCHRONIZE_DIRECT_PERMISSION), "succes sync this user for given direct permission", Response::HTTP_OK);
       }
}
