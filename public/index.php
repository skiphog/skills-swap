<?php

require dirname(__DIR__) . '/vendor/autoload.php';

session_start();

$bootstrap = new \System\Bootstrap();
$bootstrap->start();
