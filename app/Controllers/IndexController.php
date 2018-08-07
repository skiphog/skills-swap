<?php

namespace App\Controllers;

use App\Component\FormRequest;
use App\System\Controller;

class IndexController extends Controller
{
    public function index(FormRequest $request)
    {
        var_dump($request->getClientIp2long());

        return view('index/index');
    }
}
