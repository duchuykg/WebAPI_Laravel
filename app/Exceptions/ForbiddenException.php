<?php
namespace App\Exceptions;

class ForbiddenException extends \Exception{
    public function __construct($message = 'You don\'t have permission to access this resource', $code = 403) {
        parent::__construct($message, $code);
    }

}