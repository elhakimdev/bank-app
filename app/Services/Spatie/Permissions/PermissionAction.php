<?php

namespace App\Services\Spatie\Permissions;

use App\Traits\ApiResponser;
use App\Services\Spatie\Config;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Spatie\Permissions\PermissionService;

/**
 * -------------------------------------
 * Class PermissionAction
 * -------------------------------------
 * Here are implementation of our permission service class
 * 
 * You feel free to define new method to handle spatie permission operation,
 * just using our already service method that inherit form Role Service class,
 * we are extend Role Service to make the code clean and still on SOLID principle.
 * 
 * @author ElhakimDev <abdulelhakim68@gmail.com>
 * @version 1.0.0
 */
class PermissionAction extends PermissionService
{
       use ApiResponser;
       /**
        * Handle to assign permission
        *
        * @param object $model
        * @param object $permission
        * @return JsonResponse
        */
       public function handleAssignPermission(object $model, object $permission): JsonResponse
       {
              return $this->success($this->prepare($model, $permission)->handler(Config::ASSIGN_PERMISSION), "succes asssign permission", Response::HTTP_CREATED);
       }
       /**
        * Handle to remove permission
        *
        * @param object $model
        * @param object $permission
        * @return JsonResponse
        */
       public function handleRemovePermission(object $model, object $permission): JsonResponse
       {
              return $this->success($this->prepare($model, $permission)->handler(Config::REMOVE_PERMISSION), "succes remove permission", Response::HTTP_OK);
       }
       /**
        * handle to syncrhonize multiple permissions
        *
        * @param object $model
        * @param object $permission
        * @return JsonResponse
        */
       public function handleSyncDirectPermisssion(object $model, object $permission): JsonResponse
       {
              return $this->success($this->prepare($model, $permission)->handler(Config::SYNCHRONIZE_DIRECT_PERMISSION), "succes sync permission", Response::HTTP_OK);
       }
}
