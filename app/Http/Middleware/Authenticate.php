<?php

namespace App\Http\Middleware;
use App\Utilities\Traits\ResponseAPI;
use App\Exceptions\UnauthorizedException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
class Authenticate extends Middleware
{
    use ResponseAPI;
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            $this->sendError(401, 'Authenticate', 'Unauthorized');
        }
    }
}
