<?php
namespace App\Exceptions;
class UnauthorizedException extends \Exception{
    public function __construct($message = 'Unauthorized', $code = 401) {
        parent::__construct($message, $code);
    }

}