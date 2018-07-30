<?php

namespace App\Controllers\Auth;

use Wardex\Http\Request;
use App\System\Controller;

class RegistrationController extends Controller
{
    /**
     * Показать форму регистрации
     */
    public function index()
    {
    }

    /**
     * Зарегистрировать пользователя
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        /**
         * 1. Валидация реквеста
         */
    }

    /**
     * Подтвердить email
     *
     * @param Request $request
     */
    public function confirm(Request $request)
    {
    }
}
