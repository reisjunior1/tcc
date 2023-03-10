<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JogadoresRequest extends FormRequest
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
            'inApelido'=>'required',
            'inCpf'=>'required',
            'inData' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'inNome.required' => 'O campo Nome é obrigatório!',
            'inApelido.required' => 'O campo Apelido é obrigatório!',
            'inCpf.required' => 'O campo CPF é obrigatório!',
            'inTelefone.required' => 'O campo Telefone é obrigatório!',
            'inData.required' => 'O campo Data de Nascimento é obrigatório!',
        ];
    }
}
