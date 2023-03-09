<?php

namespace App\Http\Middleware\auth;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class authPage extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $emp = Auth::guard('emp')->user();
        $client = Auth::guard('cli')->user();
        if ($emp || $client) {
            return redirect()->back();
        }
        return $next($request);
    }
}
