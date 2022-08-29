<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimesJogadoresRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'ckJogador'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'ckJogador.required' => 'Selecione pelo menos um jogador!',
        ];
    }
}
