<?php

namespace App\Services\Spatie\Roles;

use App\Models\Authorization\Role;
use App\Models\User;
use App\Services\Spatie\Config;
use App\Services\Spatie\Service;

/**
 * -------------------------------------
 * Class RoleService
 * -------------------------------------
 * Base class to handle all spatie role service
 * 
 * This class is extend base service class to specifying action on the role action,
 * all method of this class must be implement Role Service Interface,
 * so if you need to add new method, feel free to sync it, 
 * and make sure that this class with their interface contracts is compatible.
 * 
 * @author ElhakimDev <abdulelhakim68@gmail.com>
 * @version 1.0.0
 */
class RoleService extends Service implements RoleServiceInterface
{
       /**
        * Role
        *
        * @var $role
        */
       public $role;
       /**
        * Define role
        *
        * @param object $role
        * @return self
        */
       public function role(object $role): self
       {
              $this->role = $role;
              return $this;
       }
       /**
        * Get the role_id
        *
        * @param object $role
        * @return self
        */
       public function getRole(object $role): self
       {
              return $role->id;
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
        * @param object $role
        * @return User
        */
       public function handler(string $method, object $model = null, object $role = null): User
       {
              switch ($method) {
                     case Config::ASSIGN_USER:
                            if ($model == null && $role == null) {
                                   return $this->model->assignRole($this->role);
                            }
                            return $model->assignRole($this->getRole($role));
                            break;
                     case Config::REMOVE_USER:
                            if ($model == null && $role == null) {
                                   return $this->model->removeRole($this->role);
                            }
                            return $model->removeRole($this->getRole($role));
                            break;
                     case Config::SYNCHRONIZE_USER:
                            if ($model == null && $role == null) {
                                   return $this->model->syncRole($this->role);
                            }
                            return $model->syncRole($this->getRole($role));
                            break;
                     default:
                            return 'no action ';
                            break;
              }
       }
       /**
        * Prepare service fr action
        *
        * @param object $model
        * @param object $role
        * @return self
        */
       public function prepare(object $model, object $role): self
       {
              return $this->model($model)->role($role);
       }
}
