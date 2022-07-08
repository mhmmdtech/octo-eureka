<?php

namespace App\Http\Requests\Admin;

use System\Request\Request;

class ChangePasswordRequest extends Request
{
    public function rules()
    {
        if (methodField() == 'put') {
            return [
                'password' => "required|min:5|max:30|password|confirmed",
            ];
        }
    }
}
