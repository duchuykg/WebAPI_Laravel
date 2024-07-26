<?php
namespace App\Exceptions;

class InvalidArgumentException extends \Exception{
    public function __construct($message = 'Invalid Argument', $code = 400) {
        parent::__construct($message, $code);
    }

}