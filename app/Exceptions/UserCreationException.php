<?php

namespace App\Exceptions;

use Exception;

class UserCreationException extends Exception
{
    public function __construct($message = 'Failed to create user')
    {
        parent::__construct($message);
    }
}
