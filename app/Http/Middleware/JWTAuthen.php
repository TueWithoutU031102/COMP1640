<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;

class JWTAuthen
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->bearerToken() == null){
            return response()->json(['error' => 'unauthenticated!'], 403);
        }
        try {
            $token = new Token( $request->bearerToken());
            $payload = JWTAuth::decode($token);
            $user = \App\Models\User::find($payload['sub']);
        } catch (TokenInvalidException $e) {
            // handle the exception here, for example:
            return response()->json(['error' => 'invalid_token'], 401);
        }
        return $next($request);
    }
}
