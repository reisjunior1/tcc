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


            'innome'=>'required',
            //'incpf'=>'required', 
            'insigla'=>'required',
            'inendereco'=>'required',
            'incidade'=>'required',
            'inbairro'=>'required',
           // 'incomplemento'=>'required',
            'incep'=>'required',
            'slestado'=>'required',
            //'id_usuario'=>'required',

            //
        ];
  
  
  }



  public function messages()
    {
        return [
            'innome.required' => 'O campo Nome é obrigatório!',
            'insigla.required' => 'O campo Sigla é obrigatório!',
            

        ];
    }





}
