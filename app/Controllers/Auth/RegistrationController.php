<?php

namespace App\Controllers\Auth;

use App\Component\Auth;
use App\Mail\RepassMail;
use System\Http\Request;
use App\Models\Users\User;
use System\Controller;
use App\Mail\RegistrationMail;
use App\Requests\RepassRequest;
use System\Mailer\Mailer;
use App\Requests\ConfirmRequest;
use System\Exceptions\NotFoundException;
use App\Requests\RegistrationRequest;

class RegistrationController extends Controller
{
    /**
     * Зарегистрировать пользователя
     *
     * @param Request             $request
     * @param RegistrationRequest $validator
     *
     * @return \System\Http\Response
     * @throws \Exception
     */
    public function store(Request $request, RegistrationRequest $validator)
    {
        $data = $request->post();
        $validator->validate($data);

        $data['password'] = password_hash(bin2hex(random_bytes(10)), PASSWORD_DEFAULT);
        $data['token'] = hash_hmac('gost', bin2hex(random_bytes(16)) . implode('', $data), time());

        $user = new User();
        $user->fill($data)->save();

        Mailer::to($user->email)->send(new RegistrationMail($user));

        return json(['status' => 1]);
    }

    public function token($token)
    {
        if (auth()->isUser()) {
            return redirect('/');
        }

        if (!$user = User::findByTokenForConfirm($token)) {
            throw new NotFoundException('Страница не найдена');
        }

        return view('auth/confirm', compact('user'));
    }

    /**
     * @return \System\Http\Response
     */
    public function repass()
    {
        if (auth()->isUser()) {
            return redirect('/');
        }

        return view('auth/repass');
    }

    /**
     * @param Request       $request
     * @param RepassRequest $validator
     *
     * @return \System\Http\Response
     * @throws \Exception
     */
    public function retoken(Request $request, RepassRequest $validator)
    {
        $data = $request->post();
        $validator->validate($data);

        if (!$user = User::findByField('email', $data['email'])) {
            return json(['errors' => ['email' => 'Такого пользователя нет в базе']], 422);
        }

        $data['password'] = password_hash(bin2hex(random_bytes(10)), PASSWORD_DEFAULT);
        $data['token'] = hash_hmac('gost', bin2hex(random_bytes(16)) . implode('', $data), time());
        $data['verified'] = 0;

        $user->fill($data)->save();

        Mailer::to($user->email)->send(new RepassMail($user));

        return json(['status' => 1]);
    }

    /**
     * Подтвердить email
     *
     * @param Request        $request
     * @param ConfirmRequest $validator
     *
     * @return \System\Http\Response
     * @throws \Exception
     */
    public function confirm(Request $request, ConfirmRequest $validator)
    {
        $data = $request->post();
        $validator->validate($data);

        if (!($user = User::findByTokenForConfirm($data['token']))) {
            return json(['status' => 1]);
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['token'] = hash_hmac('gost', bin2hex(random_bytes(16)) . implode('', $data), time());
        $data['verified'] = true;

        $user->fill($data)->save();

        Auth::attempt($user->id, $data);

        return json(['status' => 1])
            ->withSession('flash', 'Добро пожаловать');
    }
}
