<?php

namespace App\Models\Users;

use System\Model;

/**
 * Class User
 *
 * @property string                    $email
 * @property string                    $password
 * @property string                    $token
 * @property string                    $first_name
 * @property string                    $last_name
 * @property bool                      $verified
 * @property \System\SkillsDate $created_at
 *
 * @package App\Models\Users
 */
class User extends Model
{
    protected $fillable = [
        'first_name',
        'email',
        'password',
        'token',
        'verified'
    ];

    protected static $table = 'users';

    /**
     * @param $name
     * @param $value
     *
     * @return User
     */
    public static function findByField($name, $value)
    {
        $sql = "select * from users where {$name} = :value";

        $sth = db()->prepare($sql);
        $sth->execute(['value' => $value]);

        return $sth->fetchObject(static::class);
    }

    /**
     * @param $token
     *
     * @return User
     */
    public static function findByTokenForConfirm($token)
    {
        $sql = 'select * from users where token = :token and verified = 0';

        $sth = db()->prepare($sql);
        $sth->execute(['token' => $token]);

        return $sth->fetchObject(static::class);
    }

    /**
     * @param $value
     */
    public function setVerified($value)
    {
        $this->verified = (bool)$value;
    }
}
