<?php
/**
 * CanUseCreator is a trait which provide set of interaction functions 
 * between Object and User.
 * 
 * By default, when object created, the creator is also assigned for that post.
 * 
 * Usage:
 * 
 * Retrieve post list of creator which id is 1
 * Post::ofCreator(1)->get();
 *
 * Get creator email of a post
 * $post = Post::find(1);
 * $post->creator->email
 *
 * 
 * @see  http://binaty.org/docs/dev/can-use-creator
 * @author Tan Nguyen <tan@binaty.org>
 * @since  1.0
 */
namespace App;

trait CanUseCreator
{
	/**
	 * Limit the creator scope
	 * 
	 * @param  Laravel Query $query
	 * @param  Int $value Id of creator
	 *  
	 * @return Laravel Scope
	 */
	public function scopeOfCreator($query, $value)
	{
		return $query->whereCreatorId($value);
	}

	/**
	 * Get creator information
	 * 
	 * @return Laravel Relationship
	 */
	public function creator()
	{
        return $this->belongsTo('App\User', 'creator_id', 'id');
	}

	/**
	 * Auto set creator when object created
	 *
	 * @return void
	 */
	public function setCreatorIdAttribute($value = 1)
	{
		$this->attributes['creator_id'] = $value;
	}
}