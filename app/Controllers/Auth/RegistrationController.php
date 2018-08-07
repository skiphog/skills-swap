<?php

namespace App\Controllers\Auth;

use System\Controller;
use App\Component\Auth;
use App\Mail\RepassMail;
use System\Mailer\Mailer;
use App\Models\Users\User;
use App\Mail\RegistrationMail;
use App\Requests\RepassRequest;
use App\Requests\ConfirmRequest;
use App\Requests\RegistrationRequest;
use System\Exceptions\NotFoundException;

class RegistrationController extends Controller
{
    /**
     * Зарегистрировать пользователя
     *
     * @param RegistrationRequest $request
     *
     * @return \System\Http\Response
     * @throws \Exception
     */
    public function store(RegistrationRequest $request)
    {
        $request->setAttributes([
            'password' => password_hash(bin2hex(random_bytes(10)), PASSWORD_DEFAULT),
            'token'    => hash_hmac('gost', bin2hex(random_bytes(16)) . implode('', $request->all()), time())
        ]);

        $user = new User();
        $user->fill($request)->save();

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
     * @param RepassRequest $request
     *
     * @return \System\Http\Response
     * @throws \Exception
     */
    public function retoken(RepassRequest $request)
    {
        if (!$user = User::findByField('email', $request->post('email'))) {
            return json(['errors' => ['email' => 'Такого пользователя нет в базе']], 422);
        }

        $request->setAttributes([
            'password' => password_hash(bin2hex(random_bytes(10)), PASSWORD_DEFAULT),
            'token'    => hash_hmac('gost', bin2hex(random_bytes(16)) . implode('', $request->all()), time()),
            'verified' => 0
        ]);

        $user->fill($request)->save();

        Mailer::to($user->email)->send(new RepassMail($user));

        return json(['status' => 1]);
    }

    /**
     * Подтвердить email
     *
     * @param ConfirmRequest $request
     *
     * @return \System\Http\Response
     * @throws \Exception
     */
    public function confirm(ConfirmRequest $request)
    {
        if (!($user = User::findByTokenForConfirm($request->post('token')))) {
            return json(['status' => 1]);
        }

        $request->setAttributes([
            'password' => password_hash($request->post('password'), PASSWORD_DEFAULT),
            'token'    => hash_hmac('gost', bin2hex(random_bytes(16)) . implode('', $request->all()), time()),
            'verified' => 1
        ]);

        $user->fill($request)->save();

        Auth::attempt($user->id, $request->all());

        return json(['status' => 1])
            ->withSession('flash', 'Добро пожаловать');
    }
}
