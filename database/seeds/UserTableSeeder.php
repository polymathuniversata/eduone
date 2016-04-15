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
        // Create super admin
        $super_admin = factory(App\User::class, 'super_admin')->create([
            'name' => 'admin',
            'first_name' => 'Tan',
            'last_name' => 'Nguyen',
            'email' => 'tan@fitwp.com'
        ]);
        
        $users = factory(App\User::class, 60)->create();
        // Create branches
        $branches = factory(App\Branch::class, 3)->create();

        $rooms = factory(App\Room::class, 40)->create();

        $programs = factory(App\Program::class, 3)->create();

        $subjects = factory(App\Subject::class, 10)->create();
    }
}
