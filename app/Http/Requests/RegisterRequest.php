<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        // 'name', 'email', 'password',
        return [
            'nombre' =>'required|string|max:10',
            'apellidos' =>'required|string|max:20',
            'email'=>'required|string|email|max:50|unique:users',
            'password'=>'required|string|min:5'
        ];
    }
    public function messages()
    {
        return [
            'nombre.required' =>'El nombre es requerido',
            'email.unique' =>' Ya existe un registro con el email ingresado',
            'password.min' =>' El mínimo de caracteres debe ser mayor a 5',
        ];
    }
}
