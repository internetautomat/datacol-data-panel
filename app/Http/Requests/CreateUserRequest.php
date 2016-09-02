<?php

namespace App\Http\Requests;

class CreateUserRequest extends Request
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'login' => 'required|min:5|unique:users',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5',
        ];
    }
}
