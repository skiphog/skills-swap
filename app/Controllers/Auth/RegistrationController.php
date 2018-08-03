<?php

namespace App\Controllers\Auth;

use App\Exceptions\NotFoundException;
use Wardex\Http\Request;
use App\Models\Users\User;
use App\System\Controller;
use App\Mail\RegistrationMail;
use App\Component\Mailer\Mailer;
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
        $data['token'] = hash_hmac('gost', implode('', $data), time());

        $user = new User();
        $user->fill($data)->save();

        Mailer::to($user->email)->send(new RegistrationMail($user));

        return json(['status' => 1]);
    }

    public function token($token)
    {
        if (!$user = User::findByTokenForConfirm($token)) {
            throw new NotFoundException('Страница не найдена');
        }

        return view('auth/confirm', compact('user'));
    }

    /**
     * Подтвердить email
     *
     */
    public function confirm()
    {
    }
}
