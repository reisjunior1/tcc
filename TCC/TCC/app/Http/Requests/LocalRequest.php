<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocalRequest extends FormRequest
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
            'inCep'=>'required',
            'inEndereco'=>'required',
            'inCidade' => 'required',
            'slEstado' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'inNome.required' => 'O campo Nome é obrigatório!',
            'inCep.required' => 'O campo CEP é obrigatório!',
            'inEndereco.required' => 'O campo Endereço é obrigatório!',
            'inCidade.required' => 'O campo Cidade é obrigatório!',
            'slEstado.required' => 'O campo Estado é obrigatório!',
        ];
    }
}
