<?php

namespace App\Services\Spatie\Permissions;

use App\Models\User;
use App\Services\Spatie\Config;
use App\Services\Spatie\Service;

/**
 * -------------------------------------
 * Class PermissionService
 * -------------------------------------
 * Base class to handle all spatie permission service
 * 
 * This class is extend base service class to specifying action on the permission action,
 * all method of this class must be implement Permission Service Interface,
 * so if you need to add new method, feel free to sync it, 
 * and make sure that this class with their interface contracts is compatible.
 * 
 * @author ElhakimDev <abdulelhakim68@gmail.com>
 * @version 1.0.0
 */
class PermissionService extends Service implements PermissionServiceInterface
{

       /**
        * Permission
        *
        * @var $permission
        */
       public $permission;
       /**
        * Define Permission
        *
        * @param object $permission
        * @return self
        */
       public function permission(object $permission): self
       {
              $this->permission = $permission;
              return $this;
       }
       /**
        * Get the permission id
        *
        * @param object $permission
        * @return self
        */
       public function getPermission(object $permission): self
       {
              return $permission->id;
       }
       /**
        * Define the model
        *
        * @param object $model
        * @return self
        */
       public function model(object $model): self
       {
              $this->model = $model;
              return $this;
       }
       /**
        * Handle action with coupling spatie permission built in function
        *
        * @param string $method
        * @param object $model
        * @param object $permission
        * @return User
        */
       public function handler(string $method, object $model = null, object $permission = null): User
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
       /**
        * Prepare service for action
        *
        * @param object $model
        * @param object $permission
        * @return self
        */
       public function prepare(object $model, object $permission): self
       {
              return $this->model($model)->permission($permission);
       }
}
