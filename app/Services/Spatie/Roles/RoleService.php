<?php

namespace App\Services\Spatie\Roles;

use App\Services\Spatie\Config;
use App\Services\Spatie\Service;

class RoleService extends Service implements RoleServiceInterface
{
       /**
        * Instance Role
        *
        * @var [type]
        */
       public $role;

       /**
        * get role id
        *
        * @param object $role
        * @return void
        */
       public function getRole(object $role): object
       {
              return $role->id;
       }

       /**
        * set role property
        *
        * @param object $role
        * @return void
        */
       public function role(object $role): object
       {
              $this->role = $role;
              return $this;
       }
       /**
        * Handler actions
        *
        * @param string $method
        * @param object $model
        * @param object $role
        * @return object
        */
       public function handler(string $method, object $model = null, object $role = null): object
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
}
