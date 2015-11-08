<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ScopeInterface;

class ParentScope implements ScopeInterface 
{

    public function apply(Builder $builder, Model $model) 
    {
        $builder->whereRoleId(5);
    }

    public function remove(Builder $builder, Model $model) 
    { 
    	// you don't need this 
	}
}