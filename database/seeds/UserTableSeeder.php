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
        	'id'   => 1,
            'name' => 'Super Administrator',
        	'slug' => 'super_administrator',
        	'permissions' => serialize([
        		'super_admin' => 1
        	])
        ]);

        $administrator = App\Role::create([
            'id'   => 2,
            'name' => 'Administrator',
            'slug' => 'administrator',
            'permissions' => serialize([
                'super_admin' => 1
            ])
        ]);

        $teacher = App\Role::create([
            'id'   => 3,
            'name' => 'Teacher',
            'slug' => 'teacher',
            'permissions' => serialize([
                'super_admin' => 1
            ])
        ]);

        $student = App\Role::create([
            'id'   => 4,
            'name' => 'Student',
            'slug' => 'student'
        ]);

        $parent = App\Role::create([
            'id'    => 5,
            'name'  => 'Parent',
            'slug'  => 'parent'
        ]);

        $registered_user = App\Role::create([
            'id'    => 6,
            'name'  => 'Registered User',
            'slug'  => 'registered_user'
        ]);


        $super_admin = App\User::create([
            'name'          => 'admin',
            'first_name'    => 'Tan',
            'last_name'     => 'Nguyen',
            'display_name'  => 'Tan Nguyen',
            'email'         => 'tan@fitwp.com',
            'phone'         => '0932292225',
            'id_card'       => '123456789',
            'role_id'       => $superAdmin->id,
            'password'      => Hash::make('123456')
        ]);

        $walter_white = App\User::create([
            'name'          => 'walter_white',
            'first_name'    => 'Walter',
            'last_name'     => 'White',
            'display_name'  => 'Walter White',
            'email'         => 'walterwhite@cook.com',
            'phone'         => '(1) 234 5679',
            'role_id'       => $teacher->id
        ]);

        $jesse_pinkman = App\User::create([
            'name'          => 'jesse_pinkman',
            'first_name'    => 'Jesse',
            'last_name'     => 'Pinkman',
            'email'         => 'jesse_pinkman@drugdealer.com',
            'phone'         => '(1) 542 4 890',
            'role_id'       => $student->id
        ]);

        $jesse_pinkman_daddy = App\User::create([
            'name'          => 'jesse_pinkman_daddy',
            'first_name'    => 'Mr',
            'last_name'     => 'Pinkman',
            'email'         => 'mrpinkman@father.com',
            'phone'         => '(1) 04810100',
            'role_id'       => $parent->id
        ]);

        $gustavo_fring = App\User::create([
            'name'          => 'gustavo_fring',
            'first_name'    => 'Gustavo',
            'last_name'     => 'Fring',
            'email'         => 'gustavo_fring@boss.com',
            'phone'         => '(1) 49404910',
            'role_id'       => $registered_user->id
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

        $math = App\Subject::create([
            'name' => 'Math',
            'slug' => 'math',
            'grades_count' => 2,
            'sessions_count' => 2,
            'total_grade_rate' => 1,
            'minimum_student_present_session' => 1,
            'minimum_student_grade' => 40,
            'sessions_plan' => json_encode([
                [
                    'name' => 'Buoi 1',
                    'type' => '',
                    'description' => ''
                ],
                [
                    'name' => 'Buoi 2',
                    'type' => '',
                    'description' => ''
                ]
            ]),
            'grades_plan' => json_encode([
                [
                    'name' => 'Ly Thuyet',
                    'percent' => 1,
                    'minimum' => 30
                ],
                [
                    'name' => 'Thuc Hanh',
                    'percent' => 2,
                    'minimum' => 30
                ]
            ])
        ]);

        $history = App\Subject::create([
            'name' => 'History',
            'slug' => 'history',
            'grades_count' => 2,
            'sessions_count' => 2,
            'total_grade_rate' => 1,
            'minimum_student_present_session' => 1,
            'minimum_student_grade' => 40,
            'sessions_plan' => json_encode([
                [
                    'name' => 'Buoi 1',
                    'type' => '',
                    'description' => ''
                ],
                [
                    'name' => 'Buoi 2',
                    'type' => '',
                    'description' => ''
                ]
            ]),
            'grades_plan' => json_encode([
                [
                    'name' => 'Ly Thuyet',
                    'percent' => 1,
                    'minimum' => 30
                ],
                [
                    'name' => 'Thuc Hanh',
                    'percent' => 2,
                    'minimum' => 30
                ]
            ])
        ]);

        $program = App\Program::create([
            'name' => 'Cong Nghe Thong Tin',
            'slug' => 'cntt',
            'creator_id' => 1
        ]);

        $period = App\Period::create([
            'name' => 'Period 1',
            'weight' => 1,
            'ordr'  => 1,
            'program_id' => 1
        ]);

        $period->subjects()->attach(1, ['program_id' => 1, 'ordr' => 1]);
        $period->subjects()->attach(2, ['program_id' => 1, 'ordr' => 1]);

    }
}
