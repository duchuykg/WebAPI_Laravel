<?php
namespace App\Exceptions;

class NotFoundException extends \Exception{
    public function __construct($message = 'Data not found', $code = 404) {
        parent::__construct($message, $code);
    }

}