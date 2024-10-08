<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\User\EmployeeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
			'title' => $this->title,
			'image_url' => '/storage/' . $this->image_url,
			'category' => $this->category->name,
			'employee' => EmployeeResource::make($this->employee),
		];
	}
}
