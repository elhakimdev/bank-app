<?php

namespace App\Services\Spatie\Permissions;

use App\Services\Spatie\Config;
use App\Services\Spatie\Service;

class PermissionService extends Service implements PermissionServiceInterface
{
       /**
        * Instance A permission
        *
        * @var [type]
        */
       public $permission;

       /**
        * 
        *
        * @param object $permission
        * @return object
        */
       public function getPermission(object $permission): object
       {
              return $permission->id;
       }

       /**
        * 
        *
        * @param object $model
        * @return object
        */
       public function model(object $model): object
       {
              $this->model = $model;
              return $this;
       }

       /**
        * Undocumented function
        *
        * @param object $permission
        * @return object
        */
       public function permission(object $permission): object
       {
              $this->permission = $permission;
              return $this;
       }

       /**
        * 
        *
        * @param string $method
        * @param object $model
        * @param object $permission
        * @return void
        */
       public function handler(string $method, object $model = null, object $permission = null)
       {
              switch ($method) {
                     case Config::ASSIGN_DIRECT_PERMISSION:
                            if ($model == null && $permission == null) {
                                   return $this->model->givePermissionTo($this->permission);
                            }
                            return $model->givePermissionTo($this->getPermission($permission));
                            break;
                     case Config::REMOVE_DIRECT_PERMISSION:
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
