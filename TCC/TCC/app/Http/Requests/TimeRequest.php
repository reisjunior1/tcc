<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimeRequest extends FormRequest
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
            "inNometime" => 'required|max:100',
            "inSigla" => 'required|max:3',
            "inTelefone" => 'required|max:15',
            "inCep" => 'required|max:15',
            "inEndereco" => 'required|max:100',
            "inComplemento" => 'required|max:100',
            "inCidade" => 'required|max:100',
            "slEstado" => 'required|max:100',
        ];
    }



    public function messages()
    {
        return [
            'inNometime.required' => 'O campo Nome do Campeonato é obrigatório!',
            'inNometime.max:' => 'O campo Nome deve conter até 100 caracteres!',
            /*'inSigla.required|max:3',
            'inTelefone.required|max:15',
            'inCep.required|max:15',
            'inEndereco.required|max:100',
            'inComplemento;required|max:100',
            'inCidade.required|max:100',
            'slEstado.required|max:100',*/

        ];
    }





}
