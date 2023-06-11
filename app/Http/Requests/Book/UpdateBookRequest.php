<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules()
	{
		return [
			'category_id' => ['exists:categories,id'],
			'author_id' => ['exists:authors,id'],
			'title' => ['string', 'max:255'],
			'stock' => ['integer', 'min:0'],
			'description' => ['nullable', 'string'],
		];
	}

	/**
	 * Obtener los mensajes de error personalizados para las reglas de validación.
	 *
	 * @return array
	 */
	public function messages()
	{
		return [
			'category_id.exists' => 'La categoría seleccionada no existe en la base de datos.',
			'author_id.exists' => 'El autor seleccionado no existe en la base de datos.',
			'title.string' => 'El campo título debe ser una cadena de texto.',
			'title.max' => 'El campo título no debe exceder los :max caracteres.',
			'stock.integer' => 'El campo stock debe ser un número entero.',
			'stock.min' => 'El campo stock debe ser igual o mayor que :min.',
			'description.string' => 'El campo descripción debe ser una cadena de texto.',
		];
	}
}
