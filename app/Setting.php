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

    public static function get($name, $default = '', $branch_id = null)
    {
        $setting = Setting::branch($branch_id)->whereName($name)->pluck('val');

        if (empty($setting))
            $setting = config($name, $default);

        return $setting;
    }

    public function scopeBranch($query, $value)
    {
        if ( is_numeric($value))
            return $query->whereBranchId($value);

        return $query;
    }
}
