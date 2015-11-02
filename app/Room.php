<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['name', 'capacity', 'type', 'branch_id'];

    /**
     * FK Branches
     */
    public function branch() 
    {
    	return $this->belongsTo('App\Branch');
    }
}