<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Group extends Model
{
    use CanUseCreator, CanUseMeta;
	
    protected $fillable = [
    	'name', 'slug', 'description', 'email', 'users_count', 'program_id', 
    	'branch_id', 'creator', 'status', 'started_at', 'finished_at'
    ];

    protected $casts = [
    	'users_count' => 'integer',
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

    public function getUserIds()
    {
        return \DB::table('users_groups')->whereGroupId($this->id)->pluck('user_id', 'id');
    }

    /**
     * Check if this Group contains user or not
     * 
     * @param  Integer  $user_id User ID
     * @return boolean
     */
    public function hasUser($user_id)
    {
        $group_users = $this->getUserIds();
        
        if ( ! empty( $group_users ))
            return in_array($user_id, $group_users);

        return false;
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
            
            $role = 4;

            if ($safe_check) {
                
                $user = User::findOrFail($input);
                
                if ( ! $user )
                    return;

                if ('class' === $this->type && ! in_array($user->role_id, [3,4]))
                    return;

             //   $role = $user->role_id;
            }
            
            //if ($input instanceof User && isset($input->role_id))
                // $role = $input->role_id;

            // Only have Teacher and Student
            // if ($role !== 3)
            //     $role = 4;

            $creator_id = isset(\Auth::user()->id) ? \Auth::user()->id : 1;

            // Attach current user with pivot data
            $this->users()->attach($input, compact('creator_id'));
            
            $this->users_count++;
            return $this->save();
        }

        // If input is instance of App\User, then add user id
        if ($input instanceof User)
            return $this->addUser($input->id, [], false);

        // Otherwise, find user by name or email or roll no, then add by id
        $user = User::whereName($input)->orWhere('email', $input)
                    ->orWhere('roll_no', $input)->firstOrFail();

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

        if (count($user_ids) === 1 && is_array($user_ids[0]))
            $user_ids = $user_ids[0];
        
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
        if ( ! is_integer($id))
            return $this->removeUsers($id);

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
        return \DB::table('users_groups')->whereGroupId($this->id)
                ->whereUserId($user_id)->pluck('role');
    }

    public function getUsersByRole($role_id)
    {
        $all_users = \DB::table('users_groups')
                        ->whereGroupId($this->id)
                        ->pluck('user_id');
        
        $users = User::whereIn('id', $all_users)->whereRoleId($role_id)->get();

        return $users;
    }

    public function getTeachers() 
    {
        return $this->getUsersByRole(3);
    }

    public function getStudents() 
    {
        return $this->getUsersByRole(4);
    }

    public function getSubjectsTeachers()
    {
        return \DB::table('classes_subjects')
                ->whereClassId($this->id)->pluck('user_id', 'subject_id');
    }

    public function getTeacherBySubject($subject_id)
    {
        $subjects_teachers = $this->getSubjectsTeachers();

        if (isset($subjects_teachers[$subject_id]))
            return $subjects_teachers[$subject_id];

        return null;
    }

    public function getSubjectsByTeacher($teacher_id)
    {
        $subjects_teachers = $this->getSubjectsTeachers();

        $teacher_subjects = array_flip_deep($subjects_teachers);

        if (isset($teacher_subjects[$teacher_id]))
            return $teacher_subjects[$teacher_id];

        return null;
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

    public function getSubjectCompletedSessions($subject_id)
    {
        return Schedule::ofBranch(1)
                        ->whereClassId($this->id)
                        ->whereSubjectId($subject_id)->count();

    }

    public function getSubjectCompletedPercent($subject_id)
    {
        $sessions = Subject::find($subject_id)->sessions_count;

        $completed_sessions = $this->getSubjectCompletedSessions($subject_id);

        if ($completed_sessions > 0 && $sessions > 0)
            return round($completed_sessions / $sessions * 100, 2);

        return 0;
    }
}