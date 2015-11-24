<?php

namespace App\Repositories;

use App\User;

class UserRepository
{
	public function search($term)
	{
		return User::search($term);
	}
}