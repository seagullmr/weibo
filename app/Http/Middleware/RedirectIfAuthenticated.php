<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // 已登录用户再次访问登录操作时执行的动作
        if (Auth::guard($guard)->check()) {
            session()->flash('info', '您已登录，无需再次操作。');
            return redirect('/');
        }

        return $next($request);
    }
}
