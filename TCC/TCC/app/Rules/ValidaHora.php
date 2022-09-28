<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidaHora implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $hora = substr($value,0,2);
        $minuto = substr($value, 2, 2);
        
        if(strlen($value)!=4){
            return false;
        }
        if(strlen($value)!=4 
            || $hora >= 24 || $hora < 0 || $minuto >= 60 || $minuto < 0
        ){
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Hora invalida!';
        
    }
}
