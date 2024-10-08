<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'id' => $this->id,
			'email' => $this->email,
			'manager_id' => $this->manager_id,
			'role' => $this->role,
			'posts' => $this->posts()->paginate(10)
		];
	}
}
