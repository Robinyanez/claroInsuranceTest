<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidatePassword;
use App\Rules\ValidateLegalAge;

class UpdateRequest extends FormRequest
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
            'name'                  => 'required|max:100',
            'identification_card'   => 'required|digits:10|numeric|unique:users,identification_card,'.$this->id,
            'email'                 => 'required|email|unique:users,email,'.$this->id,
            'phone'                 => 'digits:10|numeric|required',
            'date_of_birth'         => ['required','date', new ValidateLegalAge(18)],
            'password'              => ['required','confirmed','string', new ValidatePassword()],
            'id_cities'             => 'required',
        ];
    }

    /**
     * Cambio de nombre a los atributos
     *
     * @return void
     */
    public function attributes()
    {
        return [
            'name'                  => 'Nombre',
            'identification_card'   => 'Cédula',
            'email'                 => 'E-mail',
            'phone'                 => 'Teléfono',
            'date_of_birth'         => 'Fecha de Nacimiento',
            'password'              => 'Contraseña',
            'id_cities'             => 'Ciudad',
        ];
    }

    /**
     * Mensajes personalizados de validación
     *
     * @return void
     */
    public function messages()
    {
        return [
            'name.required'                 => 'El :attribute ya existe.',
            'name.max'                      => 'El :attribute no debe pasar de 100 palabras.',
            'identification_card.required'  => 'La :attribute es obligarotio.',
            'identification_card.unique'    => 'La :attribute ya existe.',
            'identification_card.digits'    => 'La :attribute no debe tener menos ni pasar de 10 números.',
            'identification_card.numeric'   => 'La :attribute debe ser un tipo numérico.',
            'email.required'                => 'El :attribute es obligarotio.',
            'email.unique'                  => 'El :attribute ya existe',
            'email.email'                   => 'El :attribute debe ser tipo :attribute',
            'phone.required'                => 'La :attribute es obligarotio.',
            'phone.digits'                  => 'La :attribute no debe tener menos ni pasar de 10 números.',
            'phone.numeric'                 => 'La :attribute debe ser un tipo numérico.',
            'date_of_birth.required'        => 'La :attribute es obligarotio.',
            'password.required'             => 'La :attribute es obligatorio.',
            'password.confirmed'            => 'La :attribute debe ser igual.',
            'id_cities.required'            => 'La :attribute es obligatori0.',
        ];
    }
}
