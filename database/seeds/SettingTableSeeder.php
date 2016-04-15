<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default = [
        	['title', 'EduOne'],
        	['administrator_email', 'admin@example.com']
        ];

        foreach ($default as $row) {
        	if ( ! isset($row[2]))
        		$row[2] = 0;

        	Setting::set($row[0], $row[1], $row[2]);
        }
    }
}
