<?php

namespace App\Services\Spatie\Roles;

use App\Models\Authorization\Role;
use App\Models\User;
use App\Services\Spatie\Config;
use App\Services\Spatie\Service;

class RoleService extends Service implements RoleServiceInterface
{
       public $role;
       public function role(object $role): self
       {
              $this->role = $role;
              return $this;
       }
       public function getRole(object $role): self
       {
              return $role->id;
       }
       public function model(object $model): self
       {
              $this->model = $model;
              return $this;
       }
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
       public function prepare(object $model, object $role): self
       {
              return $this->model($model)->role($role);
       }
}
