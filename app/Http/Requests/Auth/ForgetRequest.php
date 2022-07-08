<?php

namespace App\Http\Requests\Auth;


use System\Request\Request;

class ForgetRequest extends Request
{
    protected function rules()
    {
        return [
            'email' => 'required|min:5|max:64|email'
        ];
    }
}
