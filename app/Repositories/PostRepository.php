<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\User;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
	public function getForManagerPostsPaginated(User $user, int $pagination = 10)
	{
		$posts = $user->postsByEmployees()->paginate($pagination);
		return $posts;
	}
	public function create(array $data)
	{
		$post = Post::create($data);
		return $post;
	}
	public function update(Post $post, array $data)
	{
		$post->update($data);
		$post->refresh();
		return $post;
	}
	public function delete(Post $post)
	{
		$post->delete();
		return null;
	}
	public function findOrFail(int $id)
	{
		$post = Post::findOrFail($id);
		return $post;
	}
}
