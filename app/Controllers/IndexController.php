<?php

namespace App\Controllers;

use System\Controller;

class IndexController extends Controller
{
    public function index()
    {
        var_dump($_SERVER);die;

        return view('index/index');
    }
}
