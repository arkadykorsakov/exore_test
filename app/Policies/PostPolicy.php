<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\Post;
use App\Models\User;

class PostPolicy
{
	public function store(?User $user): bool
	{
		return $user->role == Role::Employee;
	}
	public function update(?User $user, Post $post): bool
	{
		return $post->user_id == $user->id;
	}
	public function delete(?User $user, Post $post): bool
	{
		return $post->user_id == $user->id || $post->manager_id === $user->id;
	}
}
