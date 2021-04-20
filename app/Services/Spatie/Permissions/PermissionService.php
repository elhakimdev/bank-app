<?php

namespace App\Services\Spatie\Permissions;

use App\Services\Spatie\Config;
use App\Services\Spatie\Service;

class PermissionService extends Service implements PermissionServiceInterface
{

       public $permission;
       public function getPermission(object $permission): object
       {
              return $permission->id;
       }
       public function model(object $model): object
       {
              $this->model = $model;
              return $this;
       }
       public function permission(object $permission): object
       {
              $this->permission = $permission;
              return $this;
       }
       public function handler(string $method, object $model = null, object $permission = null)
       {
              switch ($method) {
                     case Config::ASSIGN_PERMISSION:
                            if ($model == null && $permission == null) {
                                   return $this->model->givePermissionTo($this->permission);
                            }
                            return $model->givePermissionTo($this->getPermission($permission));
                            break;
                     case Config::REMOVE_PERMISSION:
                            if ($model == null && $permission == null) {
                                   return $this->model->revokePermissionTo($this->permission);
                            }
                            return $model->revokePermissionTo($this->getPermission($permission));
                            break;
                     case Config::SYNCHRONIZE_DIRECT_PERMISSION:
                            if ($model == null && $permission == null) {
                                   return $this->model->syncPermissions($this->permission);
                            }
                            return $model->syncPermissions($this->getPermission($permission));
                            break;
                     default:
                            return 'no act';
                            break;
              }
       }
}
