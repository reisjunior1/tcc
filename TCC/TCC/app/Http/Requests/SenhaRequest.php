<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SenhaRequest extends FormRequest
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
            'inSenhaAtual'=>'required',
            'inNovaSenha'=>'required|min:8',
            'inConfirmaSenha'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'inNovaSenha.min' => 'A nova senha deve ter pelo menos caracteres!',
            'inSenhaAtual.required' => 'O campo Senha Atual é obrigatório!',
            'inNovaSenha.required' => 'O campo Nova Senha é obrigatório!',
            'inConfirmaSenha.required' => 'O campo Confirmar Senha é obrigatório!',
        ];
    }
}
