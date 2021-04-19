<?php

namespace App\Http\Requests\Msg;

use Illuminate\Foundation\Http\FormRequest;

class MsgRequest extends FormRequest
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
            'asunto'        => 'required|max:50',
            'destinatario'  => 'required',
            'mensaje'       => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'asunto'        => 'Asunto',
            'destinatario'  => 'Destinatario',
            'mensaje'       => 'Mensaje',
        ];
    }

    public function messages()
    {
        return [
            'asunto.required'       => 'El :attribute es obligarotio.',
            'asunto.max'            => 'El :attribute no debe pasar de 50 caracteres.',
            'destinatario.required' => 'El :attribute es obligarotio.',
            'mensaje.required'      => 'El :attribute es obligarotio.',
        ];
    }
}
