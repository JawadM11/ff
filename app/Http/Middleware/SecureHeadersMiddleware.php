<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use SecureHeaders\SecureHeaders;

class SecureHeadersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
{ $response = $next($request);
        
    return SecureHeaders::fromFile(config_path('secure-headers.php'))->apply($response);
}
}

