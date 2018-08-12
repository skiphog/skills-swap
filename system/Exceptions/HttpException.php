<?php

namespace System\Exceptions;

class HttpException extends \RuntimeException
{
    protected $code = 404;
}
