<?php
namespace App\Exceptions;

class UserAlreadyExistsException extends \Exception{
    public function __construct($message = 'User already exists', $code = 400) {
        parent::__construct($message, $code);
    }

}