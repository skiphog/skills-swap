<?php

namespace App\Models\Users;

class AuthUser extends User
{
    public static function findByToken($token)
    {
        $sql = 'select * from users where token = :token';

        $sth = db()->prepare($sql);
        $sth->execute(['token' => $token]);

        return $sth->fetchObject(static::class);
    }

    public function isUser()
    {
        return isset($this->id);
    }

    public function isGuest()
    {
        return !$this->isUser();
    }
}
