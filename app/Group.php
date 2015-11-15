<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Group extends Model
{
    use CanUseCreator, CanUseMeta;
	
    protected $fillable = [
    	'name', 'slug', 'description', 'email', 'student_count', 'program_id', 
    	'branch_id', 'creator', 'started_at', 'finished_at'
    ];

    protected $casts = [
    	'student_count' => 'integer',
    	'program_id' 	=> 'integer',
    	'branch_id' 	=> 'integer',
    	'creator_id' 	=> 'integer'
    ];

    protected $dates = ['created_at', 'updated_at'];

    /**
     * Many-to-Many Relationship with User
     *  
     * @return Relationship
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'users_groups')
                    ->withPivot('creator_id', 'role', 'status', 'date_joined', 'date_finished')
                    ->withTimestamps();
    }

    /**
     * Check if this Group contains user or not
     * 
     * @param  Integer  $user_id User ID
     * @return boolean
     */
    public function hasUser($user_id)
    {
        $group_users = \DB::table('users_groups')->whereGroupId($this->id)->lists('user_id', 'id');
        
        return in_array($user_id, $group_users);
    }

    /**
     * Add a User to Group
     * 
     * @param Mixed  $input   User ID, or User instance, or email or user name or roll no
     * @param array   $pivot  Pivot data in Group
     * @param boolean $safe_check Check user exists or not
     */
    public function addUser($input, $pivot = [], $safe_check = true)
    {
        // If input is user id, check if user exists then attach
        if (is_numeric($input) || intval($input) > 0) {

            if ($safe_check) {
                
                $user = User::findOrFail($input);
                
                if ( ! $user)
                    return;
            }
            
            return $this->users()->attach($input, ['role' => 1, 'creator_id' => 1]);
        }

        // If input is instance of App\User, then add user id
        if ($input instanceof User)
            return $this->addUser($input->id, [], false);

        // Otherwise, find user by name or email or roll no, then add by id
        $user = User::whereName($input)->orWhere('email', $input)->orWhere('roll_no', $input)->firstOrFail();

        if ($user->id > 0)
            return $this->addUser($user->id, [], false);
    }
    

    /**
     * Add mass User to Group with default role
     * 
     * @param List of User ID $user_ids List of User id
     * 
     * @return List of added users
     */
    public function addUsers(...$user_ids)
    {
        if (count($user_ids) === 1 && is_string($user_ids[0]))
            $user_ids = explode(',', $user_ids[0]);

        $added = [];

        foreach ($user_ids as $user_id) {    

            $this->addUser($user_id);

            $added[] = $user_id;
        }

        return $added;
    }

    /**
     * Remove one user from current group
     * 
     * @param  Integer $id User ID
     */
    public function removeUser($id)
    {
        return $this->users()->detach($id);
    }

    /**
     * Remove list of user from current group
     * 
     * @param  List of integers $user_ids List of users
     */
    public function removeUsers(...$user_ids)
    {
        return $this->users()->detach($user_ids);
    }

    /**
     * Set Role for User of this Group
     * 
     * @param Integer $user_id User ID
     * @param Integer $role_id Role ID
     */
    public function setRole($user_id, $role_id)
    {
        return $this->users()->updateExistingPivot($user_id, ['role' => $role_id], true);
    }

    /**
     * Get Role ID of given user in Group
     * 
     * @param  Integer $user_id User ID
     * 
     * @return Integer Role ID
     */
    public function getRole($user_id)
    {
        // Get Role of User in this Group first
        $role = \DB::table('users_groups')->whereGroupId($this->id)->whereUserId($user_id)->pluck('role');

        // If not set, then role is current user role
        if ( empty($role))
            $role = User::findOrFail($user_id)->role->id;

        return $role;
    }

    public function program()
    {
    	return $this->belongsTo('App\Program');
    }

    public function branch()
    {
    	return $this->belongsTo('App\Branch');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Subject', 'classes_subjects', 'class_id', 'subject_id')
                    ->withPivot('user_id')
                    ->withTimestamps();
    }

    public function scopeOfType($query, $value)
    {
    	return $query->whereType($value);
    }

    public function scopeOfProgram($query, $value)
    {
        if (intval($value) > 0)
            return $query->whereProgramId($value);

        return $query;
    }

    public function scopeSearch($query, $value)
    {
        if ( ! empty($value))
            return ! empty($value) ? $query->where('name', 'like', "%$value%") : $query;
    }
    
    public function scopeOfSubject($query, $value)
    {
        if ( ! empty($value))
            return $query->where('subjects_id', 'like', "%$value%");

        return $query;
    }
}
