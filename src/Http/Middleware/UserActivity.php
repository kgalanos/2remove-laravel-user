<?php

namespace Kgalanos\User\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Cache;
use Kgalanos\User\Models\User;
class UserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $expiresAt = now()->addMinutes(2); /* keep online for 2 min */

            Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);



            /* last seen */

            User::where('id', Auth::user()->id)->update([
                'last_login_at' => now(),
                'last_login_ip'=> $request->getClientIp(),
            ]);

        }
        return $next($request);
    }
}
