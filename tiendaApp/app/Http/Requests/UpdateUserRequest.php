<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        // Captura el ID desde la ruta /usuarios/{usuario}
        $userId = $this->route('usuario'); 

        return [
            'name'     => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,' . $userId,
            'email'    => 'required|email|unique:users,email,' . $userId,
            'password' => 'nullable|string|min:8|confirmed',
            'role'     => 'required|in:admin,user,empleado', // Agregué 'user'
            'status'   => 'nullable|in:activo,inactivo',    // Lo puse nullable por si no lo envías
        ];
    }
}
