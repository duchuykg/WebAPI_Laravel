<?php
namespace App\Exceptions;

class InvalidCredentialsException extends \Exception
{
    public function __construct($message = 'Invalid username or password', $code = 401)
    {
        parent::__construct($message, $code);
    }
}