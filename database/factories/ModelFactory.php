<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->defineAs(App\User::class, 'super_admin', function (Faker\Generator $faker) {
	return [
		'name' => $faker->name,
        'email' => $faker->email,
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'display_name' => $faker->firstName() . ' ' . $faker->lastName(),
        'phone'	=> $faker->phoneNumber,
        'identity_number' => $faker->randomNumber(9),
        'password' => bcrypt('123456'),
        'remember_token' => str_random(10)
	];
});


$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'display_name' => $faker->firstName() . ' ' . $faker->lastName(),
        'phone'	=> $faker->phoneNumber,
        'identity_number' => $faker->randomNumber(9),
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'role_id' => $faker->numberBetween(1, 6) 
    ];
});


$factory->define(App\Branch::class, function(Faker\Generator $faker) {
	$faker->addProvider(new Faker\Provider\en_US\Company($faker));
	return [
        'name'              => $faker->company,
        'slug'				=> str_slug($faker->company),
        'address'			=> $faker->address,
        'phone'				=> $faker->phoneNumber,
        'email'				=> $faker->email,
        'administrator_id'  => 1
	];
});

$factory->define(App\Room::class, function(Faker\Generator $faker) {
	return [
        'name'              => $faker->numerify('Room ###'),
        'capacity'			=> $faker->numberBetween(20, 80),
        'type'				=> 'Lab',
        'branch_id'			=> 1
	];
});


$factory->define(App\Program::class, function(Faker\Generator $faker) {
	return [
		'name' => $faker->name,
        'slug' => str_slug($faker->name),
        'creator_id' => 1
	];
});


$factory->define(App\Subject::class, function(Faker\Generator $faker) {
	return [
		'name' => $faker->name,
        'slug' => str_slug($faker->name),
        'grades_count' => 2,
        'sessions_count' => 2,
        'weight' => 1,
        'minimum_student_present_session' => 1,
        'minimum_student_mark' => 40,
        'sessions_plan' => [
            [
                'name' => 'Session 1',
                'type' => '',
                'description' => ''
            ],
            [
                'name' => 'Session 2',
                'type' => '',
                'description' => ''
            ]
        ],
        'grades_plan' => [
            [
                'name' => 'Theory',
                'weight' => 1,
                'minimum' => 30
            ],
            [
                'name' => 'Lab',
                'weight' => 2,
                'minimum' => 30
            ]
        ]
	];
});

$factory->define(App\Period::class, function(Faker\Generator $faker) {
	return [
		'name' 		=> numerify('Period ###'),
        'weight' 	=> 1,
        'ordr'  	=> 1,
        'program_id' => function () {
        	return App\Program::all()->random(1)->id;
        }
	];
});

$factory->define(App\Group::class, function(Faker\Generator $faker) {
	return [
		'name' => $faker->numerify('Group ###'),
		'slug'	=> str_slug($faker->numerify('Group ###')),
		'description' => $faker->lorem,
		'email'	=> $faker->email,
		'type'	=> 'class',
		'program_id' => function() {
			return App\Program::all()->random(1)->id;
		},
		'branch_id' => function () {
			return App\Branch::all()->random(1)->id;
		},
		'creator_id' => function () {
			return App\User::ofRole([1,2,3])->get()->random(1)->id;
		}
	];
});