<?php

namespace App\Http\Requests\Auth;


use System\Request\Request;

class ResetPasswordRequest extends Request
{
    protected function rules()
    {
        return [
            'password' => 'required|min:5|max:30|confirmed',
        ];
    }
}
