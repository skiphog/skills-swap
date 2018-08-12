<?php

namespace System\Exceptions;

/**
 * Class ForbiddenException
 *
 * @package App\Exceptions
 */
class ForbiddenException extends \Exception
{
    protected $code = 403;
}
