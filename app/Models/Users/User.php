<?php

namespace App\Models\Users;

use App\System\Model;

class User extends Model
{
    /**
     * @param $email
     *
     * @return bool
     */
    public static function existsEmail($email)
    {
        $sql = 'select exists(select id from users where email = :email)';

        $sth = db()->prepare($sql);
        $sth->execute(['email' => $email]);

        return (bool)$sth->fetchColumn();
    }
}
