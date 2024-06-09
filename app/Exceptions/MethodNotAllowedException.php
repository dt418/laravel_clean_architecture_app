<?php

namespace App\Exceptions;

use Exception;

class MethodNotAllowedException extends Exception
{
    public function __construct($message = 'The method is not allowed for the requested route.')
    {
        parent::__construct($message);
    }
}
