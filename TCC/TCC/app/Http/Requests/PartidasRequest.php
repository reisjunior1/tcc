<?php

namespace App\Http\Requests;

use App\Rules\ValidaHora;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Throwable;

class PartidasRequest extends FormRequest
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
            'slTimeCasa'=>'required|notin:Selecione...',
            'slTimeVizitante'=>'required|notin:Selecione...',
            'slLocal'=>'required|notin:Selecione...',
            'inData' => 'required',
            'inHora' => 'required|numeric'
        ];
    }

        public function messages()
        {
            return [
                'slTimeCasa.notin' => 'O campo Time mandante é obrigatório!',
                'slTimeVizitante.notin' => 'O campo Time visitante é obrigatório!',
                'slLocal.notin' => 'O campo Local é obrigatório!',
                'inData.required' => 'O campo Data é obrigatório!',
                'inHora.required' => 'O campo Hora é obrigatório!',
                'inHora.numeric' => 'O campo Hora deve conter apenas números!',
                //'inHora.max' => 'O campo Hora não pode conter mais de 4 digítos',
                //'inHora.min' => 'O campo Hora deve conter 4 digítos'
            ];
        }
}
