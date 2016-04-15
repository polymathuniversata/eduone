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
    	// Array of rows to be inserted to settings table.
    	// each array must follow format [$name, $val, $branch_id(optional)]
        $default = [
        	['title', 'EduOne'],
        	['administrator_email', 'admin@example.com']
        ];

        foreach ($default as $row) {
        	if ( ! isset($row[2]))
        		$row[2] = 0; // If doesn't set $branch_id, then branch is Master

        	Setting::set($row[0], $row[1], $row[2]);
        }
    }
}
