<?php

namespace App\Controllers;

use System\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('index/index');
    }
}
