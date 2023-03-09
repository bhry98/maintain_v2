<?php

namespace App\Http\Middleware\auth\blockpage;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class emp extends Middleware
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
        if ($emp->active == 1 ) {
            return redirect()->route('emp.dash');
        }
        return $next($request);
    }
}
