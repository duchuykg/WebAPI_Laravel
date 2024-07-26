<?php

namespace App\Repositories\Contracts;

interface IAuthRepository
{
    public function login($data);
    public function register($data);
}