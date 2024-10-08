<?php

namespace App\Repositories\Interfaces;

use App\Enums\Role;

interface UserRepositoryInterface
{
	public function store(array $data, Role $role, int $managerId = null);
	public function getByUserId(int $id, array $query = []);
}
