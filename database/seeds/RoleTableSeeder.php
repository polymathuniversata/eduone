<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Role::create([
        	'id'   => 1,
            'name' => 'Super Administrator',
        	'slug' => 'super_administrator',
        	'permissions' => [
        		'super_administrator' => 1
        	]
        ]);

        App\Role::create([
            'id'   => 2,
            'name' => 'Administrator',
            'slug' => 'administrator',
            'permissions' => [
                'administrator' => 1
            ]
        ]);

        App\Role::create([
            'id'   => 3,
            'name' => 'Lecturer',
            'slug' => 'lecturer',
            'permissions' => []
        ]);

       	App\Role::create([
            'id'   => 4,
            'name' => 'Student',
            'slug' => 'student'
        ]);

        App\Role::create([
            'id'    => 5,
            'name'  => 'Parent',
            'slug'  => 'parent'
        ]);

        App\Role::create([
            'id'    => 6,
            'name'  => 'Registered User',
            'slug'  => 'registered_user'
        ]);
    }
}
