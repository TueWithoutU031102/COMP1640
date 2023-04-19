<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTAuthen
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(
                [
                    'error' => $e->getMessage(),
                    'token' => $request->bearerToken(),
                    'code' => $e->getMessage()
                ], 403);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'token_invalid', 'token' => $request->bearerToken()], 403);
        } catch (JWTException $e) {
            return response()->json(['error' => 'token_absent', 'code' => $e->getCode()], 403);
        }
        return $next($request);
    }
}
