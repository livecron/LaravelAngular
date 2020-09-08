<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
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
        // 'nombre', 'precio', 'descripcion', 'categoria_id', 'user_id',
        return [
            'nombre'=>'required',
            'categoria_id' =>'required',
            'precio' =>'required|numeric',

        ];
    }
    public function messages()
    {
      return [
          'nombre.required' => 'El nombre es requerido',
          'categoria_id.required' => 'La categoria es requerido',
          'precio.required' => 'El precio es requerido',
          'precio.numeric' => 'Dato incorrecto',
      ];
    }
}
