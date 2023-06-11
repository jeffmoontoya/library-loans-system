<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $userId = $this->route('user')->id; // Assuming the route parameter name is 'user'

        return [
            'name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'number_id' => ['required', 'numeric', 'unique:users,number_id,' . $userId],
            'email' => ['required', 'email', 'unique:users,email,' . $userId],
            'password' => ['nullable', 'string', 'min:8', 'confirmed']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido.',
            'name.string' => 'El nombre no es válido.',

            'last_name.required' => 'El apellido es requerido.',
            'last_name.string' => 'El apellido no es válido.',

            'number_id.required' => 'El documento es requerido.',
            'number_id.numeric' => 'El documento debe ser un número.',
            'number_id.unique' => 'El documento ya está en uso.',

            'email.required' => 'El email es requerido.',
            'email.email' => 'El email no es válido.',
            'email.unique' => 'El email ya está en uso.',

            'password.string' => 'La contraseña debe ser válida.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'La contraseña no coincide.'
        ];
    }
}
