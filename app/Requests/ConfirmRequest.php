<?php

namespace App\Requests;

use System\Http\FormRequest;

class ConfirmRequest extends FormRequest
{
    protected static $messages = [
        'password.min' => 'Пожалуйста, придумайте пароль, который больше трех символов'
    ];

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'password' => 'required|min:3',
            'token'    => 'required',
        ];
    }
}
