<?php

namespace TopSystem\UCenter\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        auth()->setDefaultDriver(app('UCenterGuard'));

        if (!Auth::guest()) {
            return Auth::user() ? $next($request) : redirect('/');
        }

        $urlLogin = route('ucenter.login');
        return redirect()->guest($urlLogin);
    }

}