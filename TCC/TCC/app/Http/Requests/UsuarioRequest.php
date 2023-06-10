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
            'email' => 'required_without:telefone'|'max:255'|'unique:users',
            'telefone' => 'required_without:email'|'min:13'|'max:15'|'unique:users'
        ];
        
    }


public function messages()
    {
        return [
            'email.required_without' => 'O campo Nome é obrigatório!',
            'telefone.required_without' => 'O campo Telefone é obrigatório!',
        ];
    }
}

