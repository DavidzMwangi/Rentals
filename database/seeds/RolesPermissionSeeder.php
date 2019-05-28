<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        $permission_1= Permission::create(['name' => 'Add Landlords']);
        $permission_2=  Permission::create(['name' => 'Deactivate Landlords ']);
        $permission_3=   Permission::create(['name' => 'Add New Apartments']);
        $permission_4=  Permission::create(['name' => 'Post room condition']);

        // create roles and assign created permissions  0-admin 1-landlord 2-tenant
        $role=   Role::create([ 'name' => 'Admin']);
        $role->givePermissionTo([$permission_1,$permission_2]);

        $role1= Role::create(['name' => 'LandLord']);
        $role1->givePermissionTo($permission_3);

        $role2= Role::create(['name' => 'Tenant']);
        $role2->givePermissionTo($permission_4);



    }
}
