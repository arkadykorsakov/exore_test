<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			'title' => 'required',
			'category_id' => 'required|integer|exists:categories,id',
			'image' => 'nullable|image|mimes:jpeg,png,webp,jpg,gif|dimensions:max_width=3000,max_height=3000|max:10240',
		];
	}

	public function messages(): array
	{
		return [
			'required' => 'Поле обязательно для заполнения.',
			'category_id.integer' => 'Идентификатор категории должен быть числом.',
			'category_id.exists' => 'Выбранная категория не существует.',
			'image.image' => 'Файл должен быть изображением.',
			'image.mimes' => 'Допустимые форматы изображений: jpeg, wepb, png, jpg, gif.',
			'image.dimensions' => 'Изображение должно иметь максимальную ширину 3000 пикселей и высоту 3000 пикселей.',
			'image.max' => 'Размер изображения не должен превышать 10 МБ.',
		];
	}
}
