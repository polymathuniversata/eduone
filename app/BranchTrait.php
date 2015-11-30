<?php

namespace App;

trait BranchTrait
{
	public function scopeOfBranch($query, $value)
	{
		return $query->whereBranchId($value);
	}

	public function scopeInBranches($query, $value)
	{
		return $query->has('branches', '=', $value);
	}

	public function branch()
	{
		return $this->belongsTo('App\Branch');
	}
}