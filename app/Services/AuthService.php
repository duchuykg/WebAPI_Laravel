<?php

namespace App\Services;

use App\Services\Contracts\IAuthService;
use App\Validations\Rules;
use App\Utilities\Traits\ValidateAPI;
use App\Repositories\Contracts\IAuthRepository;

class AuthService implements IAuthService
{
    use ValidateAPI;
    /**
     * Summary of authRepository
     * @var 
     */
    protected $authRepository;

    public function __construct(IAuthRepository $authRepository){
        $this->authRepository = $authRepository;
    }
    public function login($data){
        $this->validate($data, RULES::AUTH_RULE);  
        return $this->authRepository->login($data);
    }

    public function register($data){
        $this->validate($data, RULES::AUTH_RULE);  
        return $this->authRepository->register($data);
    }
}

