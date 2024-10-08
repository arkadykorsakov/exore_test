<?

namespace App\Actions;

use App\Models\User;

class CreateNewToken
{
	public function handle(User $user)
	{
		return  $user->createToken(env('token'))->plainTextToken;
	}
}
