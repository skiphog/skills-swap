<?php

namespace App\Models\Users;

use App\System\Model;

/**
 * Class User
 *
 * @property string                    $email
 * @property string                    $password
 * @property string                    $token
 * @property string                    $first_name
 * @property string                    $last_name
 * @property bool                      $verified
 * @property \App\Component\SkillsDate $created_at
 *
 * @package App\Models\Users
 */
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

    public function setVerified($value)
    {
        $this->verified = (bool)$value;
    }
}
