<?php

namespace App\Requests;

use System\Http\FormRequest;

class RepassRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email'
        ];
    }
}
