<?php

namespace App\Requests;

use App\Models\Users\User;
use System\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    public function email($value)
    {
        $this->trowIfEmpty($value, 'email');

        if (false === filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Проверьте корректность Email');
        }

        if (User::existsEmail($value)) {
            throw new \InvalidArgumentException('Такой email уже существует');
        }
    }

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
