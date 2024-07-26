<?php

namespace App\Services\Contracts;

interface IAuthService
{
    public function login($data);
    public function register($data);
}