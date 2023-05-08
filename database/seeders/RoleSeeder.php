<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get('database/json/roles.json');
        $roles = collect(json_decode($json));

        $roles->each(function ($role) {
            if (Role::where('name', '=', $role->name)->count() == 0) {
                Role::create([
                    'name' => $role->name,
                    'guard_name' => $role->guard_name,
                ]);
            }
        });
    }
}
