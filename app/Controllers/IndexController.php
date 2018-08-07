<?php

namespace App\Controllers;

use System\Http\FormRequest;
use System\Controller;

class IndexController extends Controller
{
    public function index(FormRequest $request)
    {
        var_dump($request->getClientIp2long());

        return view('index/index');
    }
}
