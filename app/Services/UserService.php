<?

namespace App\Services;

use App\Enums\Role;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserService
{
	private $userRepository;

	public function __construct(UserRepositoryInterface $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	public function store(Request $request)
	{
		$data = $request->validated();
		$user = $this->userRepository->store($data, Role::Employee, auth()->id());
		return $user;
	}

	public function showEmployee(int $id)
	{
		$user = $this->userRepository->getByUserId($id, ['role' => Role::Employee]);
		return $user;
	}
}
