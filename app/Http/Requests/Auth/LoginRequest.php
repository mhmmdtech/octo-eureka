<?php

namespace App\Http\Requests\Auth;


use System\Request\Request;

class LoginRequest extends Request
{
    protected function rules()
    {
        return [
            'username' => "required|min:4|max:20",
            'password' => "required|min:5|max:30|password",
        ];
    }
}
