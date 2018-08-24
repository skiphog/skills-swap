<?php

namespace App\Models\Users;

class AuthUser extends User
{
    public function isUser()
    {
        return isset($this->id);
    }

    public function isGuest()
    {
        return !$this->isUser();
    }

    public function findBySession($id)
    {
    }

    public function findByToken($token)
    {
    }
}
