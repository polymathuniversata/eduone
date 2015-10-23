<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
	// Branch can use meta data
	use CanUseMeta;
	
    protected $fillable = ['name', 'address', 'country', 'state', 'postcode', 'phone',
    	'email', 'language', 'currency', 'timezone', 'administrator_id'
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
}