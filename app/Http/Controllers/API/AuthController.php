<?php

namespace App\Http\Controllers\API;

use App\Actions\CreateNewToken;
use App\Actions\CreateNewUser;
use App\Enums\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\User\EmployeeResource;
use App\Http\Resources\User\ManagerResource;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
	/**
	 * Register api
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function register(RegisterRequest $request, CreateNewUser  $createNewUser, CreateNewToken $createNewToken)
	{
		$data = $request->validated();
		$user = $createNewUser->handle($data, Role::Manager);
		$success['token'] =  $createNewToken->handle($user);

		return $this->sendResponse($success, 'Пользователь успешно зарегистрирован.');
	}

	/**
	 * Login api
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function login(LoginRequest $request, CreateNewToken $createNewToken)
	{
		$data = $request->validated();
		if (Auth::attempt($data)) {
			$user = Auth::user();
			$success['token'] = $createNewToken->handle($user);
			return $this->sendResponse($success, 'Пользователь успешно вошел в систему.');
		} else {
			return $this->sendError('Unauthorized.', ['error' => 'Неверный Email или пароль'], 401);
		}
	}

	public function me()
	{
		$user = auth()->user();
		$success = null;
		if ($user->role === Role::Employee) {
			$success = EmployeeResource::make($user);
		} elseif ($user->role === Role::Manager) {
			$success = ManagerResource::make($user);
		}
		return $this->sendResponse($success, 'Данные текущего пользователя.');
	}
}
