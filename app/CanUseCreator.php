<?php

namespace App;

trait CanUseCreator
{
	public function scopeOfCreator($query, $value)
	{
		return $query->whereCreatorId($value);
	}

	public function creator()
	{
        return $this->belongsTo('App\User', 'creator_id', 'id');
	}
}