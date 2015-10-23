<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, CanUseCreator, CanUseMeta;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'first_name', 'last_name', 'email', 'password', 'phone',
        'date_of_birth', 'id_card', 'id_card_issued_date', 'id_card_expired_date',
        'id_card_issued_by', 'gender', 'roll_no', 'photo', 'postcode', 'address', 'state',
        'country', 'media', 'department_id', 'categories', 'expired_date', 'role_id', 'permissions',
        'remember_token', 'status', 'creator_id','created_at', 'updated_at', 'deleted_at'
    ];

    protected $casts = [
        'permissions' => 'array'
    ];
    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    // protected $guarded = ['_token', 'password_confirmation'];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function branches()
    {
        return $this->belongsToMany('App\Branch', 'users_branches');
    }
}
