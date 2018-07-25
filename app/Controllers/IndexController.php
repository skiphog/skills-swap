<?php

namespace App\Controllers;

use App\System\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('index/index');
    }
}
