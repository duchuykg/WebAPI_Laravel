<?php

namespace App\Repositories;

use App\Models\User;
use App\Support\JWT\JWTBuilder;
use App\Exceptions\UserAlreadyExistsException;
use App\Exceptions\InvalidCredentialsException;
use App\Repositories\Contracts\IAuthRepository;
use App\Utilities\Traits\JWTAPI;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements IAuthRepository
{
    use JWTAPI;

    public function login($data)
    {
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];
        
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw new InvalidCredentialsException();
        }
        return $this->generateToken($user);
    }

    public function register($data)
    {
        if(User::where('email', $data['email'])->exists()) throw new UserAlreadyExistsException();

        return User::create(array_merge($data, ['password' => bcrypt($data['password'])]));
    }

    
}

