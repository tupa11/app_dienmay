<?php

namespace App\Http\Middleware;

use Closure;

class SentinelPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null)
    {
        $admin = $request->user()->load('role');
        if ($admin && (($permission == null || $admin->role->permission == null || $admin->authorized($permission)))) {
            return $next($request);
        } else {
            return redirect('/')->withErrors(['message' => __('message.not_authorized')]);
        }
    }
}
