<?php

namespace App\Controllers\Auth;

use System\Controller;
use App\Component\Auth;
use System\Http\Request;
use App\Models\Users\User;
use App\Requests\LoginRequest;

class AuthController extends Controller
{
    /**
     * Аутентификация пользователя
     *
     * @param Request      $request
     * @param LoginRequest $validator
     *
     * @return \System\Http\Response
     */
    public function login(Request $request, LoginRequest $validator)
    {
        $data = $request->post();
        $validator->validate($data);

        if (!$user = User::findByField('email', $data['email'])) {
            return json(['errors' => ['email' => 'Такого пользователя нет в базе']], 422);
        }

        if (!password_verify($data['password'], $user->password)) {
            return json(['errors' => ['password' => 'Парль неверный']], 422);
        }

        $data['token'] = $user->token;
        Auth::attempt($user->id, $data);

        return json(['status' => 1])->withSession('flash', 'Привет мой маленький, прыщавый друг');
    }

    /**
     * Выход
     */
    public function logout()
    {
        Auth::logout();

        return back()->withSession('flash', 'Где-то загрустил админ :(');
    }
}
