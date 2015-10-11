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
        $user_id = App\User::create([
        	'name' 			=> 'admin',
        	'first_name' 	=> 'Tan',
        	'last_name' 	=> 'Nguyen',
        	'email'			=> 'tan@fitwp.com',
        	'phone'			=> '0932292225',
        	'id_card'		=> '123456789'
        ]);

        $administrator = DB::table('groups')->insert([
        	'name' => 'Administrator',
        	'slug' => 'administrator',
        	'permissions' => serialize([
        		'super_admin' => 1
        	])
        ]);

        DB::table('users_groups')->insert([
        	'user_id' 	=> $user_id,
        	'group_id' 	=> $administrator,
        	'creator' 	=> 0
        ]);
    }
}
