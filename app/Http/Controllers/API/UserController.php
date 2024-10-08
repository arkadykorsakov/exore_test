<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\User\StoreRequest;
use App\Http\Resources\User\EmployeeResource;
use App\Services\UserService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Gate;

class UserController extends BaseController
{
	private $userService;
	public function __construct(UserService $userService)
	{
		$this->userService = $userService;
	}

	public function store(StoreRequest $request)
	{
		if (!Gate::allows('store-employee')) {
			return $this->sendError('Создавать сотрудников имеет право только менеджер.', [], 403);
		}
		try {
			$user = $this->userService->store($request);
			return $this->sendResponse('Сотрудник создан', ['employee' => EmployeeResource::make($user)]);
		} catch (Exception $e) {
			return $this->sendError('Не удалось создать сотрудника.');
		}
	}

	public function showEmployee(int $id)
	{
		try {
			$employee = $this->userService->showEmployee($id);
			if (!Gate::allows('show-employee', $employee)) {
				return $this->sendError('У вас нет прав просматривать данного сотрудника.', [], 403);
			}
			return $this->sendResponse('Данные сотрудника.', ['employee' => EmployeeResource::make($employee)]);
		} catch (Exception $e) {
			if ($e instanceof ModelNotFoundException) {
				return $this->sendError('Пост не найден.', [], 404);
			}
			return $this->sendError('Ошибка при получении данных сотрудника');
		}
	}
}
