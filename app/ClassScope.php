<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ScopeInterface;

class ClassScope implements ScopeInterface 
{

    public function apply(Builder $builder, Model $model) 
    {
        $builder->whereType('class');
    }
}