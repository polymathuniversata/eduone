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
            'name' => 'FPT Polytechnic'
        ]);

        $room = App\Room::create([
            'name'      => 'L101',
            'capacity'  => 40,
            'type'      => 'Lab',
            'branch_id' => $branch->id
        ]);

        $subject = App\Subject::create([
            'name' => 'HTML5',
            'slug' => 'html5',
            'grades_count' => 2,
            'sessions_count' => 2,
            'total_grade_rate' => 30,
            'minimum_student_grade' => 50,
            'grade_type' => 'Vietnamese',
            'sessions_plan' => [
                [
                    'type' => 't',
                    'name' => 'Heading Tags',
                    'description' => 'Learn About Basic and heading tags'
                ],
                [
                    'type' => 't',
                    'name' => 'Heading Tags',
                    'description' => 'Learn About Basic and heading tags'
                ],
            ],
            'grades_plan' => [
                [
                    'name' => 'Theory',
                    'percent' => 40,
                    'minimum' => 40
                ],
                [
                    'name' => 'Lab',
                    'percent' => 60,
                    'minimum' => 40
                ]
            ]
        ]);

        $program = App\Program::create([
            'name' => 'Computer Science',
            'slug' => 'cs',
            'periods_count' => 1,
            'periods' => [
                [
                    'name' => 'Period 1',
                    'weight' => 1,
                    'subjects' => [$subject->id]
                ]
            ]
        ]);

        $class = App\Classes::create([
            'name' => 'PT0701',
            'branch_id' => $branch->id,
            'program_id' => $program->id
        ]);

        // DB::table('users_roles')->insert([
        // 	'user_id' 	=> $user_id,
        // 	'role_id' 	=> $administrator,
        // 	'creator' 	=> 0
        // ]);
    }
}
