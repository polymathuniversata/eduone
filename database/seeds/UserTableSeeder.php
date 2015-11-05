<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = App\Role::create([
        	'name' => 'Administrator',
        	'slug' => 'administrator',
        	'permissions' => serialize([
        		'super_admin' => 1
        	])
        ]);

        $teacher = App\Role::create([
            'name' => 'Teacher',
            'slug'  => 'teacher',
            'permissions' => []
        ]);

        $user = App\User::create([
            'name'          => 'admin',
            'first_name'    => 'Tan',
            'last_name'     => 'Nguyen',
            'email'         => 'tan@fitwp.com',
            'phone'         => '0932292225',
            'id_card'       => '123456789',
            'role_id'       => $superAdmin->id
        ]);

        $branch = App\Branch::create([
            'name'              => 'FPT Polytechnic',
            'administrator_id'  => $superAdmin->id
        ]);

        $room = App\Room::create([
            'name'      => 'L101',
            'capacity'  => 40,
            'type'      => 'Lab',
            'branch_id' => $branch->id
        ]);

        // DB::table('users_roles')->insert([
        // 	'user_id' 	=> $user_id,
        // 	'role_id' 	=> $administrator,
        // 	'creator' 	=> 0
        // ]);
    }
}
