<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public function set($name, $value, $branch_id = null)
    {
    	$setting = new Setting;

    	$setting->name 	= $name;
    	$setting->val 	= $value;

    	if (null != $branch_id)
    		$setting->branch_id = $branch_id;

    	$setting->update();
    }

    public function has()
    {
    	
    }

    public function get()
    {

    }
}
