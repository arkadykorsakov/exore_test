<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\User;

class UserPolicy
{
	public function showEmployee(?User $user, User $employee): bool
	{
		return $user->id == $employee->manager_id;
	}

	public function store(?User $user): bool
	{
		return $user->role === Role::Manager;
	}
}
