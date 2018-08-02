<?php

namespace App\Controllers\Auth;

use App\Models\Users\User;
use Wardex\Http\Request;
use App\System\Controller;
use App\Validate\RegistrationValidate;

class RegistrationController extends Controller
{
    /**
     * Показать форму регистрации
     */
    public function index()
    {
        return view('auth/registration');
    }

    /**
     * Зарегистрировать пользователя
     *
     * @param Request              $request
     * @param RegistrationValidate $validator
     *
     * @return \Wardex\Http\Response
     */
    public function store(Request $request, RegistrationValidate $validator)
    {
        $data = $request->post();
        $validator->validate($data);

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['token'] = hash_hmac('sha512', implode('', $data), time());

        $user = new User();
        $user->fill($data)->save();


        return json(['status' => $user->id]);
    }

    /**
     * Подтвердить email
     *
     */
    public function confirm()
    {
    }
}
