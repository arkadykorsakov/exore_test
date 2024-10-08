<?

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
{



	public function store(string $dirPath, UploadedFile $file)
	{
		$filePath = Storage::disk('public')->put($dirPath, $file);
		return $filePath;
	}

	public function destroy(string $filePath)
	{
		Storage::disk('public')->delete($filePath);
		return null;
	}
}
