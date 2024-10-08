<?

namespace App\Actions;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Http\Request;

class CreateNewUser
{
	public function handle(array $data, Role $role,  int $mangerId = null)
	{
		$data['password'] = bcrypt($data['password']);
		$data['role'] = $role;
		$data['manager_id'] = $mangerId;

		$user = User::create($data);

		return  $user;
	}
}
