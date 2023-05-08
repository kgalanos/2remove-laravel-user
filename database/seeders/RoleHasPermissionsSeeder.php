<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Kgalanos\User\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleHasPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var User $user */
        $user =User::where('username','admin')->firstOrFail();

        /** @var Role $role */
        $role = Role::where('name','super_admin')->firstOrFail();

        /** @var Permission $permissions */
        $permissions = Permission::all();

        $permissions->each(function($permission)use(/** @var Role $role */$role){
            if(! $role->hasPermissionTo($permission))
                $role->givePermissionTo($permission);
        });
        if(! $user->hasRole($role))
            $user->assignRole($role);
        $user->is_admin=true;
        $user->save();

        $role = Role::where('name','Broker')->firstOrFail();
        $permissions = Permission::where('name', 'like', '%::anex');
        $permissions->each(function($permission)use($role) {
            if(!$role->hasPermissionTo($permission))
                $role->givePermissionTo($permission);
        });
        $permissions = Permission::where('name', 'like', '%::eisf');

        $permissions->each(function($permission)use($role) {
            if(!$role->hasPermissionTo($permission))
                $role->givePermissionTo($permission);
        });
        $permissions = Permission::where('name', 'like', '%::ist');
        $permissions->each(function($permission)use($role) {
            if(!$role->hasPermissionTo($permission))
                $role->givePermissionTo($permission);
        });
        $permissions = Permission::where('name', 'like', '%::sym');
        $permissions->each(function($permission)use($role) {
            if(!$role->hasPermissionTo($permission))
                $role->givePermissionTo($permission);
        });
        $permissions = Permission::where('name', 'like', '%::symap');
        $permissions->each(function($permission)use($role) {
            if(!$role->hasPermissionTo($permission))
                $role->givePermissionTo($permission);
        });
        $permissions = Permission::where('name', 'like', '%::symox');
        $permissions->each(function($permission)use($role) {
            if(!$role->hasPermissionTo($permission))
                $role->givePermissionTo($permission);
        });
        $permissions = Permission::where('name', 'like', '%::symprost');
        $permissions->each(function($permission)use($role) {
            if(!$role->hasPermissionTo($permission))
                $role->givePermissionTo($permission);
        });
        $permissions = Permission::where('name', 'like', '%MyProfile');
        $permissions->each(function($permission)use($role) {
            if(!$role->hasPermissionTo($permission))
                $role->givePermissionTo($permission);
        });

        $users= User::all();
        $users->each(function ($user)use($role){
            if(is_numeric($user->username)) {
                if(!$user->hasRole($role))
                    $user->assignRole($role);
            }
        });
    }
}
