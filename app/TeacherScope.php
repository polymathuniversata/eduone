<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ScopeInterface;

class TeacherScope implements ScopeInterface 
{

    public function apply(Builder $builder, Model $model) 
    {
        $builder->whereRoleId(3);
    }
}