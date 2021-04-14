<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Authorization\Role;
use App\Models\Authorization\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create roles and assign existing permissions
        $memberRole = Role::create(['name' => 'member']);
        $memberRole->givePermissionTo($this->getMemberPermission(['viewAny', 'view']));

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo($this->getAdminPermission(['create', 'update', 'delete']));

        $superadminRole = Role::create(['name' => 'super-admin']);
        $superadminRole->givePermissionTo($this->getSuperAdminPermission(Permission::all()));
    }
    private function getMemberPermission($memberPerm): array
    {
        return $memberPerm;
    }
    private function getAdminPermission($adminPerm): array
    {
        return $adminPerm;
    }
    private function getSuperAdminPermission($superAdmniPerm): object
    {
        return $superAdmniPerm;
    }
}
