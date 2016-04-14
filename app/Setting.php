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
        try {
            $setting = Setting::ofBranch($branch_id)->whereName($name)->first();

            if ($setting)
                return $setting->value('val');
            
            if (empty($setting))
                $setting = config($name, $default);

            return $setting;
        } catch (Exception $e) {
            return null;
        }
    }

    public static function has($name, $branch_id)
    {
        return Setting::ofBranch($branch_id)->whereName($name)->first()->exists;
    }

    public function scopeOfBranch($query, $value)
    {
        if ( is_numeric($value))
            return $query->whereBranchId($value);

        return $query;
    }
}
