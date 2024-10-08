<?php

namespace App\Repositories;

use App\Actions\CreateNewUser;
use App\Enums\Role;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
	private $createNewUser;

	public function __construct(CreateNewUser $createNewUser)
	{
		$this->createNewUser = $createNewUser;
	}

	public function store(array $data, Role $role, int $managerId = null)
	{
		$user = $this->createNewUser->handle($data, $role, $managerId);
		return $user;
	}

	public function getByUserId(int $id, array $query = [])
	{
		$user = User::where('id', $id);
		foreach ($query as $key => $value) {
			$user->where($key, $value);
		}
		$user = $user->firstOrFail();
		return $user;
	}
}
