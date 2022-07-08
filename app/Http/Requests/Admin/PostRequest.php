<?php

namespace App\Http\Requests\Admin;

use System\Request\Request;

class PostRequest extends Request
{
    public function rules()
    {
        if (methodField() == 'put') {
            return [
                'title' => "required|min:5|max:50",
                'category_id' => "required|exists:categories,id",
                'thumbnail' => 'file|mimes:jpeg,jpg,png,gif,bmp,tiff,tif,webp|max:5120',
                'attachments' => 'file|max:20480',
                'description' => "required|min:10|max:255",
                'body' => "required",
            ];
        } else {
            return [
                'title' => "required|min:5|max:50",
                'category_id' => "required|exists:categories,id",
                'thumbnail' => 'required|file|mimes:jpeg,jpg,png,gif,bmp,tiff,tif,webp|max:5120',
                'attachments' => 'file|max:20480',
                'description' => "required|min:10|max:255",
                'body' => "required",
            ];
        }
    }
}
