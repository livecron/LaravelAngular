<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
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
            'nombre' => 'required|min:3|max:15|unique:categorias'
        ];
    }
    public function messages()
    {
        return [
            'nombre.required' =>'El nombre es requerido',
            'nombre.unique' =>' Ya existe un registro con el nombre ingresado',
            'nombre.max' =>' Solo se permiten 15 caracteres',
        ];
    }
}
