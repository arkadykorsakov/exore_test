<?php

namespace App\Repositories\Interfaces;

use App\Models\Post;
use App\Models\User;

interface PostRepositoryInterface
{
	public function create(array $data);
	public function update(Post $post, array $data);
	public function delete(Post $post);
	public function findOrFail(int $id);
}
