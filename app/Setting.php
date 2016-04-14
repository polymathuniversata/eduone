<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $fillable = ['id', 'name', 'val', 'branch_id'];

    public static function set($name, $value, $branch_id = null)
    {
        $branch_id = $branch_id === null ? Branch::currentId() : $branch_id;

    	$setting = Setting::firstOrNew([
            'branch_id' => $branch_id,
            'name'      => $name
        ]);

        $setting->val = $value;

        return $setting->save();
    }

    public static function get($name, $branch_id = null, $fallback = true, $default = '')
    {
        $branch_id = $branch_id === null ? Branch::currentId() : $branch_id;

        try {
            $setting = Setting::whereBranchId($branch_id)->whereName($name)->first();
            
            // If found setting. Return value
            if ($setting)
                return $setting->val;

            // If not found. Find in Master branch
            if (empty($setting) && $fallback && $branch_id != 0)
                $setting = self::get($name, 0, true, $default);

            // If still not found. Find in config file
            if (empty($setting))
                $setting = config($name, $default);

            return $setting;
        } catch (Exception $e) {
            return null;
        }
    }

    public function scopeOfBranch($query, $value)
    {
        if ( is_numeric($value))
            return $query->whereBranchId($value);

        return $query;
    }
}
