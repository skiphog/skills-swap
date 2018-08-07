<?php

namespace App\Controllers\Auth;

use System\Controller;
use App\Component\Auth;
use App\Models\Users\User;
use App\Requests\LoginRequest;

class AuthController extends Controller
{
    /**
     * Аутентификация пользователя
     *
     * @param LoginRequest $request
     *
     * @return \System\Http\Response
     */
    public function login(LoginRequest $request)
    {
        if (!$user = User::findByField('email', $request->post('email'))) {
            return json(['errors' => ['email' => 'Такого пользователя нет в базе']], 422);
        }

        if (!password_verify($request->post('password'), $user->password)) {
            return json(['errors' => ['password' => 'Парль неверный']], 422);
        }

        $request->setAttributes(['token' => $user->token]);

        Auth::attempt($user->id, $request->all());

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
