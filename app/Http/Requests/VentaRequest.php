<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VentaRequest extends FormRequest
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
//        'codigo', 'monto',
        return [
            'monto'=>'required|numeric',
        ];
    }
    public function messages()
    {
        return [
          'monto.required' => ' El monto es requerido',
          'monto.numeric' => ' El monto no es válido',
        ];
    }
}
