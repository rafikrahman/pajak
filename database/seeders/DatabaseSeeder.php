<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $user1 = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
        ]);

         $user2 = User::factory()->create([
             'name' => 'Editing',
             'email' => 'edit@test.com',
         ]);

        $role = Role::Create(['name' => 'Admin']);
        $user1->assignRole($role);

         $role = Role::Create(['name' => 'Editing']);
         $user2->assignRole($role);
    }
}
