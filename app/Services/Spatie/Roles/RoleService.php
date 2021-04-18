<?php

namespace App\Services\Spatie\Roles;


class RoleService implements RoleServiceInterface
{

       public function getModel(object $model)
       {
              return $model->id;
       }
       public function getRole(object $role)
       {
              return $role->id;
       }
       public function model($model)
       {
              $this->model = $model;
              return $this;
       }
       public function role($role)
       {
              $this->role = $role;
              return $this;
       }
       public function handler(string $method, object $model = null, object $role = null)
       {
              switch ($method) {
                     case 'assign-user':
                            # code...
                            if ($model == null && $role == null) {
                                   # code...
                                   return $this->model->assignRole($this->role);
                            }
                            return $model->assignRole($this->getRole($role));
                            break;
                     case 'remove-user':
                            # code...
                            if ($model == null && $role == null) {
                                   # code...
                                   return $this->model->removeRole($this->role);
                            }
                            return $model->removeRole($this->getRole($role));
                            break;

                     default:
                            # code...
                            return 'no action ';
                            break;
              }
       }
}
