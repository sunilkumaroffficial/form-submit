<?php

namespace Database\Seeders;

use App\Models\RoleModel;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin'],
            ['name' => 'User'],
        ];

        foreach ($roles as $role) {
            RoleModel::create($role);
        }
    }
}
