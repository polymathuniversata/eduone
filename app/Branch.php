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
}