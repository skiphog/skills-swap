<?php

namespace App\Requests;

use System\Http\FormRequest;

class LoginRequest extends FormRequest
{
    protected static $rules = [
        'email'    => 'email',
        'password' => 'required|min:3'
    ];
}
