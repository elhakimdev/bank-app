<?php

namespace App\Services\Spatie\Permissions;

use App\Services\Spatie\Config;
use App\Services\Spatie\Service;

class PermissionService extends Service implements PermissionServiceInterface
{

       public $permission;
       public function permission(object $permission): self
       {
              $this->permission = $permission;
              return $this;
       }
       public function getPermission(object $permission): object
       {
              return $permission->id;
       }
       public function model(object $model): self
       {
              $this->model = $model;
              return $this;
       }
       public function handler(string $method, object $model = null, object $permission = null): self
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
       public function prepare(object $model, object $permission): self
       {
              return $this->model($model)->permission($permission);
       }
}
