<?php

namespace App\Http\Middleware;

use App\Http\Controllers\AuthenticateController;
use Closure;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        $user = User::where("email", $request->email)->where("password", bcrypt($request->password))->get();
        if ($request->token == AuthenticateController::KEY) {
            return $next($request);
        } else {
            abort(401);
        }
    }
}
