<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::factory()->create([
            'name' => 'DROSE',
            'email' => 'oudom@marinax.co.jp',
            'password' => Hash::make('marinax'),
            'profile' => 'default.jpg',
        ]);
        // DB::table('users')->insert([
        //     'name' => 'DROSE',
        //     'email' => 'oudom@marinax.co.jp',
        //     'password' => Hash::make('marinax')
        // ]);

        $userRole = Role::create(['name' => 'user']);
        $adminRole = Role::create(['name' => 'admin']);

        $permissions = Permission::whereIn('name', ['create-users', 'edit-users', 'delete-users'])->get();
        //pluck('id', 'id')->all();

        $adminRole->givePermissionTo($permissions);

        $user->assignRole([$adminRole->id]);


        // Permission::create(['name' => 'create-users']);
        // Permission::create(['name' => 'edit-users']);
        // Permission::create(['name' => 'delete-users']);


        // $adminRole->givePermissionTo([
        //     'create-users',
        //     'edit-users',
        //     'delete-users'
        // ]);
    }
}
