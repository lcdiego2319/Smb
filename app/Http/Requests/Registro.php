<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Registro extends Request
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
     * @return array
     */
    public function rules()
    {
        return [
            'username'=>'required|alpha_num|size:8|min:1',
            'password'=>'required|confirmed|min:1',
            'password_confirmation'=>'required|confirmed|min:1'
        ];
    }
}

