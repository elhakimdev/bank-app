<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use App\Models\Authorization\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        // create permissions

        Permission::create(['name' => 'viewAny']);
        /**member */
        Permission::create(['name' => 'view']);
        /**member */

        Permission::create(['name' => 'create']);
        /**admin */
        Permission::create(['name' => 'update']);
        /**admin */
        Permission::create(['name' => 'delete']);
        /**admin */
        Permission::create(['name' => 'restore']);
        /**admin */
    }
}
