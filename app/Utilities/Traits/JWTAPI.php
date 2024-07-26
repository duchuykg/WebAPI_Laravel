<?php

namespace App\Utilities\Traits;

use App\Support\JWT\JWTBuilder;
use Exception;

trait JWTAPI
{
    public function generateToken($user)
    {
        $builder = JWTBuilder::getInstance()->getBuilder();

        $now = new \DateTimeImmutable();
        $expirationTime = $now->modify('+1 hour');
        $token = $builder
            ->setUser($user)
            ->setIssuedAt($now->getTimestamp())
            ->setExpiration($expirationTime->getTimestamp())    
            ->build(config('app.key'));

        return $token;
    }

    public function decode($token)
    {
        if (!$token) throw new Exception();
        return JWTBuilder::getInstance()->decode($token, config('app.key'));
    }
   
}