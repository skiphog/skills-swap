<?php

namespace App\Component;

use App\Models\Users\AuthUser;

/**
 * Class Auth
 *
 * @package App\Component
 */
class Auth
{
    /**
     * @var AuthUser
     */
    protected $user;

    public function __construct()
    {
        $this->init();
    }

    /**
     * @return AuthUser
     */
    public function getAuthUser()
    {
        return $this->user;
    }

    protected function init()
    {
        $id = self::identifier();

        if (!empty($_SESSION[$id]) && $user = AuthUser::findById($_SESSION[$id])) {
            return $this->user = $user;
        }

        if (!empty($_COOKIE['token']) && $user = AuthUser::findByField('token', $_COOKIE['token'])) {
            $_SESSION[$id] = $user->id;

            return $this->user = $user;
        }

        return $this->user = new AuthUser();
    }


    public static function attempt($id, iterable $data)
    {
        $_SESSION[self::identifier()] = $id;

        if (!empty($data['remember'])) {
            setcookie('token', $data['token'], 0x7FFFFFFF, '/', '', false, true);
        }
    }

    public static function logout()
    {
        unset($_SESSION[self::identifier()]);

        //session_destroy();

        $time = time() - 3600;

        foreach (['token'] as $value) {
            setcookie($value, '', $time, '/', '');
        }
    }

    /**
     * Сгенерировать идентификатор
     *
     * @return string
     */
    public static function identifier(): string
    {
        return sprintf('user_%s', md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']));
    }
}
