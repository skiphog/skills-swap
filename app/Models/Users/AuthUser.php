<?php

namespace App\Models\Users;

class AuthUser extends User
{
    public static function findBySessionId($id)
    {
        $sql = 'select * from users where id = ' . (int)$id . ' and `status` = 1 limit 1';

        return db()->query($sql)
            ->fetchObject(static::class);
    }

    public static function findByToken($token)
    {
        $sql = 'select * from users where token = :token and `status` = 1 limit 1';

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
