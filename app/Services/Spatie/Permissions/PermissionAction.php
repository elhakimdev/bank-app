<?php

namespace App\Services\Spatie\Permissions;

use App\Traits\ApiResponser;
use App\Services\Spatie\Config;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Spatie\Permissions\PermissionService;

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
       public function handleAssignPermission(object $model, object $permission): JsonResponse
       {
              return $this->success($this->prepare($model, $permission)->handler(Config::ASSIGN_PERMISSION), "succes asssign permission", Response::HTTP_CREATED);
       }
       public function handleRemovePermission(object $model, object $permission): JsonResponse
       {
              return $this->success($this->prepare($model, $permission)->handler(Config::REMOVE_PERMISSION), "succes remove permission", Response::HTTP_OK);
       }
       public function handleSyncDirectPermisssion(object $model, object $permission): JsonResponse
       {
              return $this->success($this->prepare($model, $permission)->handler(Config::SYNCHRONIZE_DIRECT_PERMISSION), "succes sync permission", Response::HTTP_OK);
       }
}
