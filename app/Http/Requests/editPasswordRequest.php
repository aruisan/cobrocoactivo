<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class editPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'passwordActual' => 'required',
            'password' => 'required|same:passwordC|min:6',
            'passwordC' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'passwordActual.required' => 'Contraseña actual requerido',
            'Password.required' => 'Password requerido',
            'PasswordC.required' => 'confirmar password requerido',    
            'Password.same' => 'password y confirmacion password no coinciden.',
            'Password.min' => 'el password debe tener minimo 6 caracteres.',
        ];
    }
}
