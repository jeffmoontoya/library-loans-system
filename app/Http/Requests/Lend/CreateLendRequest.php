<?php

namespace App\Http\Requests\Lend;

use Illuminate\Foundation\Http\FormRequest;

class CreateLendRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize()
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
			'owner_user_id' => ['required', 'exists:users,id'],
			'customer_user_id' => ['nullable', 'exists:users,id'],
			'book_id' => ['nullable', 'exists:books,id'],
			'date_out' => ['required', 'date'],
			'date_in' => ['required', 'date', 'after_or_equal:date_out'],
			'status' => ['required', 'in:lend,returned']
		];
	}

	public function messages()
	{
		return [
			'owner_user_id.required' => 'El ID del propietario es requerido.',
			'owner_user_id.exists' => 'El ID del propietario no existe en la tabla de usuarios.',

			'customer_user_id.exists' => 'El ID del cliente no existe en la tabla de usuarios.',

			'book_id.exists' => 'El ID del libro no existe en la tabla de libros.',

			'date_out.required' => 'La fecha de salida es requerida.',
			'date_out.date' => 'La fecha de salida no es válida.',

			'date_in.required' => 'La fecha de entrada es requerida.',
			'date_in.date' => 'La fecha de entrada no es válida.',
			'date_in.after_or_equal' => 'La fecha de entrada debe ser igual o posterior a la fecha de salida.',

			'status.required' => 'El estado es requerido.',
			'status.in' => 'El estado no es válido. Los valores permitidos son: lend, returned.'
		];
	}
}
