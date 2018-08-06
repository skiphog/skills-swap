<?php

namespace App\Controllers\Auth;

use App\Component\Auth;
use App\Mail\RepassMail;
use Wardex\Http\Request;
use App\Models\Users\User;
use App\System\Controller;
use App\Mail\RegistrationMail;
use App\Validate\RepassValidate;
use App\Component\Mailer\Mailer;
use App\Validate\ConfirmValidate;
use App\Exceptions\NotFoundException;
use App\Validate\RegistrationValidate;

class RegistrationController extends Controller
{
    /**
     * Зарегистрировать пользователя
     *
     * @param Request              $request
     * @param RegistrationValidate $validator
     *
     * @return \Wardex\Http\Response
     * @throws \Exception
     */
    public function store(Request $request, RegistrationValidate $validator)
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
     * @return \Wardex\Http\Response
     */
    public function repass()
    {
        if (auth()->isUser()) {
            return redirect('/');
        }

        return view('auth/repass');
    }

    /**
     * @param Request        $request
     * @param RepassValidate $validator
     *
     * @return \Wardex\Http\Response
     * @throws \Exception
     */
    public function retoken(Request $request, RepassValidate $validator)
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
     * @param Request         $request
     * @param ConfirmValidate $validator
     *
     * @return \Wardex\Http\Response
     * @throws \Exception
     */
    public function confirm(Request $request, ConfirmValidate $validator)
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
