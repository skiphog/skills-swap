<?php

namespace App\Controllers\Auth;

use App\Component\Auth;
use Wardex\Http\Request;
use App\Models\Users\User;
use App\System\Controller;
use App\Validate\LoginValidate;

class AuthController extends Controller
{
    /**
     * Аутентификация пользователя
     *
     * @param Request       $request
     * @param LoginValidate $validator
     *
     * @return \Wardex\Http\Response
     */
    public function login(Request $request, LoginValidate $validator)
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
