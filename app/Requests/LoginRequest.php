<?php

namespace App\Requests;

use System\Http\FormRequest;

class LoginRequest extends FormRequest
{

    protected static $messages = [
        'email.email'  => 'Пожалуйста, введите корректный электронный адрес',
        'password.min' => 'Слишком короткий пароль'
    ];

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email'    => 'required|email',
            'password' => 'required|min:3'
        ];
    }
}
