<?

namespace App\Services;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Services\FileService;
use Illuminate\Http\Request;

class PostService
{
	private $postRepository;
	private $fileService;

	public function __construct(FileService $fileService, PostRepositoryInterface $postRepository)
	{
		$this->fileService = $fileService;
		$this->postRepository = $postRepository;
	}

	public function store(Request $request)
	{
		$data = $request->validated();
		$file = $data['image'];
		unset($data['image']);
		$data['image_url'] = $this->fileService->store('uploads/posts', $file);
		$data['user_id'] = auth()->user()->id;
		$data['manager_id'] = auth()->user()->manager->id;
		$post = $this->postRepository->create($data);
		return $post;
	}

	public function update(Post $post, Request $request)
	{
		$data = $request->validated();
		if (isset($data['image'])) {
			$this->fileService->destroy($post['image_url']);
			$file = $data['image'];
			unset($data['image']);
			$data['image_url'] = $this->fileService->store('uploads/posts', $file);
		}
		$postUpdated = $this->postRepository->update($post, $data);
		return $postUpdated;
	}

	public function getForManagerPostsPaginated()
	{
		$user = auth()->user();
		$posts = $this->postRepository->getForManagerPostsPaginated($user);
		return $posts;
	}

	public function destroy(Post $post)
	{
		$this->fileService->destroy($post['image_url']);
		$this->postRepository->delete($post);
		return null;
	}

	public function show(int $id)
	{
		$post = $this->postRepository->findOrFail($id);
		return $post;
	}
}
