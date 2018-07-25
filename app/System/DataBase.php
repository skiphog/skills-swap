<?php

namespace App\System;

class DataBase extends \PDO
{
    public function __construct()
    {
        $config = config('db');

        parent::__construct(
            "mysql:dbname={$config['dbname']};host={$config['host']};charset=utf8mb4",
            $config['username'],
            $config['password'],
            $config['options']
        );
    }
}
