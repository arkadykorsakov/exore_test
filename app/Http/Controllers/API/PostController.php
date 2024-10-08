<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\Post\PostResource;
use App\Services\PostService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Gate;

class PostController extends BaseController
{
	private $postService;
	public function __construct(PostService $postService)
	{
		$this->postService = $postService;
	}

	public function store(StoreRequest $request)
	{
		if (!Gate::allows('store-post')) {
			return $this->sendError('Создавать посты имеет право только сотрудник.', [], 403);
		}
		try {
			$post = $this->postService->store($request);
			return $this->sendResponse(['post' => PostResource::make($post)], 'Пост создан', 201);
		} catch (Exception $e) {
			return $this->sendError('Не удалось создать пост.');
		}
	}

	public function update(int $id, UpdateRequest $request)
	{
		try {
			$post = $this->postService->show($id);
			if (!Gate::allows('update-post', $post)) {
				return $this->sendError('Нет прав на обновление этого поста.', [], 403);
			}
			$postUpdated = $this->postService->update($post, $request);
			return $this->sendResponse(['post' => PostResource::make($postUpdated)], 'Пост обновлён', 200);
		} catch (Exception $e) {
			if ($e instanceof ModelNotFoundException) {
				return $this->sendError('Пост не найден.', [], 404);
			}
			return $this->sendError('Не удалось обновить пост.');
		}
	}

	public function getByEmployeePostsPaginated()
	{
		$posts = PostResource::collection($this->postService->getForManagerPostsPaginated());
		return $this->sendResponse(['posts' => $posts], 'Посты сотрудников.');
	}

	public function destroy(int $id)
	{
		try {
			$post = $this->postService->show($id);
			if (!Gate::allows('delete-post', $post)) {
				return $this->sendError('Нет прав для удаления данного поста', [], 403);
			}
			$this->postService->destroy($post);
			return $this->sendResponse([], 'Пост удален.', 200);
		} catch (Exception $e) {
			if ($e instanceof ModelNotFoundException) {
				return $this->sendError('Пост не найден.', [], 404);
			}
			return $this->sendError('Не удалось обновить пост.');
		}
	}
}
