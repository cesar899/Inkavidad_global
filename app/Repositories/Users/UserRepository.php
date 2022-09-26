<?php

namespace App\Repositories\Users;

// Models
use App\Models\User;

class UserRepository
{
	public function create($data) {
		return User::create($data);
	}
}
