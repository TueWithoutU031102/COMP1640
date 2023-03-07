<?php

namespace App\Http\Middleware\is;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class QAM
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user(); // lay thong tin khi dang nhap
        $route = $request->route()->getName();
        if (!($request->user()->isQAM() || $request->user()->isAdmin($request)))
            return redirect()->route("forbidden");
        return $next($request);
    }
}
