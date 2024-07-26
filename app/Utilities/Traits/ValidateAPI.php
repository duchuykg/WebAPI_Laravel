<?php

namespace App\Utilities\Traits;

use Illuminate\Support\Facades\Validator;
use App\Exceptions\InvalidArgumentException;

trait ValidateAPI
{
    /**
     * Summary of validate
     * @param mixed $data
     * @param mixed $rule
     * @throws \App\Exceptions\InvalidArgumentException
     * @return void
     */
    public function validate($data, $rule){
        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->toJson());
        }
    }
   
}