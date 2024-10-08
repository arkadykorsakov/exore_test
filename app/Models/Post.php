<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	use HasFactory;

	protected $fillable = [
		'title',
		'image_url',
		'category_id',
		'user_id',
		'manager_id',
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function employee()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}
