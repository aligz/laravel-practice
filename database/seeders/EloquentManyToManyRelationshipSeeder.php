<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EloquentManyToManyRelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::factory()->create(['id' => 1]);
        $role2 = Role::factory()->create(['id' => 2]);
        User::find(1)->roles()->saveMany([
            $role1, $role2
        ]);
    }
}
