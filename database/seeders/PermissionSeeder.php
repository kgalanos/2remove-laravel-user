<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json= File::get('database/json/permissions.json');
        $permissions = collect(json_decode($json));

        $permissions->each(function($permission) {
            if(Permission::where('name', '=', $permission->name)->count() == 0 )
                Permission::create([
                    'name' => $permission->name,
                    'guard_name' => $permission->guard_name,
                ]);
        });
    }
}
