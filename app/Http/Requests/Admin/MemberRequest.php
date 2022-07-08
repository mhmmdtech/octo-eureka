<?php

namespace App\Http\Requests\Admin;

use System\Request\Request;

class MemberRequest extends Request
{
    public function rules()
    {


        if (methodField() == 'put') {
            return [
                'name' => "required|min:4|max:20",
                'family' => "required|min:4|max:20",
                'avatar' => "file|mimes:jpeg,jpg,png,gif,bmp,tiff,tif,webp|max:5120",
                'role' => "min:5|max:10",
            ];
        } else {
            return [
                'name' => "required|min:4|max:20",
                'family' => "required|min:4|max:20",
                'username' => "required|min:4|max:20|unique:members,username",
                'email' => "required|min:5|max:64|email|unique:members,email",
                'password' => "required|min:5|max:30|password|confirmed",
                'avatar' => "required|file|mimes:jpeg,jpg,png,gif,bmp,tiff,tif,webp|max:5120",
                'role' => "required|min:5|max:10",
            ];
        }
    }
}
