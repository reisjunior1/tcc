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

           
                'innome'=>'required',
                'incpf'=>'required',
                'intelefone'=>'required',
                'inemail' => 'required',
                'insenha' => 'required',
                'intipo'=>'required'
            ];
        
    }


public function messages()
    {
        return [
            'innome.required' => 'O campo Nome é obrigatório!',
            'incpf.required' => 'O campo CPF é obrigatório!',
            'intelefone.required' => 'O campo Telefone é obrigatório!',
            'intipo.required' => 'O campo Tipo é obrigatório!',
            'insenha.required' => 'O campo Senha é obrigatório!',

        ];
    }
}