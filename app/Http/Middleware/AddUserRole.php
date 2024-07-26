<?php

namespace App\Http\Middleware;

use App\Utilities\Traits\JWTAPI;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Exceptions\ForbiddenException;
use Exception;

class AddUserRole
{
    use JWTAPI;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $request['role'] = $this->getRole($request);
        return $next($request);
    }

    private function getToken($request){
        $authorization = $request->header('Authorization');
        return !preg_match('/^Bearer\s+(.*)$/i', $authorization, $matches) ? null : $matches[1];
    }

    private function getRole($request){
        try {
            $token = $this->getToken($request);
            $user = $this->decode($token);
            if (!$user) return 'Guest';
            return $user['type'] == 0 ? 'Member' : 'Admin';
        } catch (Exception $e) {
            return 'Guest';
        }
    }
}
