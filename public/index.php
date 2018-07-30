<?php

require dirname(__DIR__) . '/vendor/autoload.php';

session_start();

$bootstrap = new \App\System\Bootstrap();
$bootstrap->start();
