<?php

namespace App\Http\Middleware;

use Closure;
use App\Utilities\Traits\ResponseAPI;
use App\Exceptions\ForbiddenException;
use App\Exceptions\UnauthorizedException;

class CheckRole
{
    use ResponseAPI;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$allowRoles) 
    {
        if (in_array($request->role, $allowRoles)) return $next($request);
        if ($request->role == 'Guest') throw new UnauthorizedException();
        else throw new ForbiddenException();
    }
}
