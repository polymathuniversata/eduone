<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{	
    protected $fillable = ['name', 'slug', 'address', 'phone',
    	'email', 'administrator_id'
    ];

    /**
     * Foreign key to User
     * @return direction
     */
    public function admin()
    {
        return $this->belongsTo('App\User', 'administrator_id');
    }

    public function rooms()
    {
        return $this->hasMany('App\Room');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'users_branches');
    }

    public static function switch($id = null)
    {
        $user = \Auth::user();
        
        $master = [
            'id'    => 0,
            'name'  => 'Master'
        ];

        try {   
            // If current user isn't super admin. Do not allows access Master
            if ( ! $user->isSuperAdmin() && $id == 0)
                $id = null;

            if ($user->isSuperAdmin() && $id === null)
                $id = 0;
   
            // If not set the target. Switch to the first one.
            if (null === $id) {
                $branch = $user->branches->first()->toArray();
            }
            
            if ($id > 0) {
                $branch = self::findOrFail($id)->toArray();
            }

            if ($id == 0) {
                $branch = $master;
            }



        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            if ($user->isSuperAdmin()) {
                $branch = $master;
            }   
        }

        session(['branch' => $branch]);
        session(['branch_id' => $branch['id']]);
        
    }

    public static function current()
    {
        return session('branch');
    }

    public static function currentId()
    {
        return session('branch_id');
    }
}