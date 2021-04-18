<?php

namespace App\Services\Spatie\Roles;

/**
 * Role Service interface
 */
interface RoleServiceInterface
{
       /**
        * Handler method
        *
        * @param string $method
        * @param object $model
        * @param object $role
        * @return void
        */
       public function handler(string $method, object $model, object $role);
}
