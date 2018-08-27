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
     * @param $value
     */
    public function setVerified($value)
    {
        $this->verified = (bool)$value;
    }
}
