<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampeonatosRequest extends FormRequest
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
            'inNomeCampeonato'=>'required',
            'slFormato'=>'required|in:PC,CP,MM',
            'inDataInicio'=>'required',
            'inDataFim' => 'required',
            'inNumeroTimes' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'inNomeCampeonato.required' => 'O campo Nome do Campeonato é obrigatório!',
            'slFormato.in' => 'O campo Formato é obrigatório!',
            'inDataInicio.required' => 'O campo Data Inicio é obrigatório!',
            'inDataFim.required' => 'O campo Data Fim é obrigatório!',
            'inNumeroTimes.required' => 'O campo Número de Times Participantes é obrigatório!',
        ];
    }
}
