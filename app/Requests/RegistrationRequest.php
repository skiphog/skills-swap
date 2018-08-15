<?php

namespace App\Requests;

use System\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    protected static $messages = [
        'first_name.required' => 'Пожалуйста, заполните ваше Имя',
        'first_name.max'      => 'Разве может быть такое длинное Имя?',
        'email.unique'        => 'Такой пользователь уже существует'
    ];

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|max:100',
            'email'      => 'required|email|unique:users',
            'confirm'    => 'required'
        ];
    }
}
