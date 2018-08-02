<?php

namespace App\Models\Users;

use App\System\Model;

class User extends Model
{
    protected $fillable = [
        'first_name',
        'email',
        'password',
        'token'
    ];

    protected static $table = 'users';

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
