<?php

namespace App\Services\Spatie\Roles;


class RoleService implements RoleServiceInterface
{
       /**
        * get model id
        *
        * @param object $model
        * @return void
        */
       public function getModel(object $model)
       {
              return $model->id;
       }

       /**
        * get role id
        *
        * @param object $role
        * @return void
        */
       public function getRole(object $role)
       {
              return $role->id;
       }

       /**
        * set model property
        *
        * @param [type] $model
        * @return void
        */
       public function model(object $model): object
       {
              $this->model = $model;
              return $this;
       }

       /**
        * set role property
        *
        * @param [type] $role
        * @return void
        */
       public function role($role)
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
        * @return void
        */
       public function handler(string $method, object $model = null, object $role = null)
       {
              switch ($method) {
                     case 'assign-user':
                            if ($model == null && $role == null) {
                                   return $this->model->assignRole($this->role);
                            }
                            return $model->assignRole($this->getRole($role));
                            break;
                     case 'remove-user':
                            if ($model == null && $role == null) {
                                   return $this->model->removeRole($this->role);
                            }
                            return $model->removeRole($this->getRole($role));
                            break;
                     default:
                            return 'no action ';
                            break;
              }
       }
}
