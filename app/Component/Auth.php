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
        $id = self::identificator();

        if (!empty($_SESSION[$id]) && $user = AuthUser::findById($_SESSION[$id])) {
            return $this->user = $user;
        }

        if (!empty($_COOKIE['token']) && $user = AuthUser::findByToken($_COOKIE['token'])) {
            $_SESSION[$id] = $user->id;

            return $this->user = $user;
        }

        return $this->user = new AuthUser();
    }

    /**
     * Сгенерировать идентефикатор
     *
     * @return string
     */
    public static function identificator(): string
    {
        return sprintf('user_%s', md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']));
    }
}
