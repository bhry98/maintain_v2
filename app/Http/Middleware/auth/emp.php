<?php

namespace App\Http\Middleware\auth;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;


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
        if (!Auth::guard('emp')->user()) {
            session()->flash('hent');
            session()->flash('theme', "Danger");
            session()->flash('title', null);
            session()->flash('mess', __("app.Errors.EndSession"));
            return redirect()->route('emp.auth.ViewLogin');
        } elseif (Auth::guard('emp')->user()->active == 0) {
            return redirect()->route('emp.auth.Block');
        } else {
            config()->set('auth.defaults.guard', 'emp');
            return $next($request);
        }
    }
}
