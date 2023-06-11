<?php

namespace App\Http\Requests\Lend;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLendRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'owner_user_id' => ['sometimes', 'exists:users,id'],
            // El campo owner_user_id es opcional (a veces) y debe existir en la tabla de usuarios con un id coincidente.

            'customer_user_id' => ['nullable', 'exists:users,id'],
            // El campo customer_user_id es nulo (opcional) y debe existir en la tabla de usuarios con un id coincidente.

            'book_id' => ['nullable', 'exists:books,id'],
            // El campo book_id es nulo (opcional) y debe existir en la tabla de libros con un id coincidente.

            'date_out' => ['sometimes', 'date'],
            // El campo date_out es opcional (a veces) y debe tener un formato de fecha válido.

            'date_in' => ['sometimes', 'date', 'after_or_equal:date_out'],
            // El campo date_in es opcional (a veces) y debe tener un formato de fecha válido. Además, debe ser posterior o igual a la fecha en date_out.

            'status' => ['sometimes', 'in:lend,returned']
            // El campo status es opcional (a veces) y debe ser uno de los valores especificados: lend o returned.
        ];
    }

    public function messages()
    {
        return [
            'owner_user_id.exists' => 'El ID del propietario no existe en la tabla de usuarios.',
            // Mensaje de error de validación para owner_user_id cuando no existe en la tabla de usuarios.

            'customer_user_id.exists' => 'El ID del cliente no existe en la tabla de usuarios.',
            // Mensaje de error de validación para customer_user_id cuando no existe en la tabla de usuarios.

            'book_id.exists' => 'El ID del libro no existe en la tabla de libros.',
            // Mensaje de error de validación para book_id cuando no existe en la tabla de libros.

            'date_out.date' => 'La fecha de salida no es válida.',
            // Mensaje de error de validación para date_out cuando no tiene un formato de fecha válido.

            'date_in.date' => 'La fecha de entrada no es válida.',
            // Mensaje de error de validación para date_in cuando no tiene un formato de fecha válido.

            'date_in.after_or_equal' => 'La fecha de entrada debe ser igual o posterior a la fecha de salida.',
            // Mensaje de error de validación para date_in cuando no es posterior o igual a la fecha en date_out.

            'status.in' => 'El estado no es válido. Los valores permitidos son: lend, returned.'
            // Mensaje de error de validación para status cuando no es uno de los valores especificados: lend o returned.
        ];
    }
}
