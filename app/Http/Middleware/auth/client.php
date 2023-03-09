<?php

namespace App\Http\Middleware\auth;

use Closure;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;


class client extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (!Auth::guard('cli')->user()) {
            session()->flash('hent');
            session()->flash('theme', "Danger");
            session()->flash('title', null);
            session()->flash('mess', __("app.Errors.EndSession"));
            return redirect()->route('cli.auth.ViewLogin');
        } elseif (Auth::guard('cli')->user()->active == 0) {
            return redirect()->route('cli.auth.Block');
        } else {
            config()->set('auth.defaults.guard', 'cli');
            return $next($request);
        }
    }
}
