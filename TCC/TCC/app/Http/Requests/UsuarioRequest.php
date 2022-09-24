<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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

           
                'inNome'=>'required',
                'inCpf'=>'required',
                'inTelefone'=>'required',
                'inEmail'=>'required',
                'inSenha'=>'required',
                'inSenha2'=>'required',
          ];
        
    }


public function messages()
    {
        return [
            'inNome.required' => 'O campo Nome é obrigatório!',
            'inCpf.required' => 'O campo CPF é obrigatório!',
            'inTelefone.required' => 'O campo Telefone é obrigatório!',
            'inEmail.required' => 'O campo Tipo é obrigatório!',
            'inSenha.required' => 'O campo Senha é obrigatório!',
            'inSenha2.required' => 'O campo Confirmar Senha é obrigatório!',

        ];
    }
}

