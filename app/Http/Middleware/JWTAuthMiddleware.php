<?php
namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;

class JWTAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Get token from Authorization header
            $token = $request->header('Authorization');
            if (!$token) {
                return response()->json(['error' => 'Token not provided'], 401);
            }
    
            // Set and authenticate token
            JWTAuth::setToken(str_replace('Bearer ', '', $token));
    
            if (!JWTAuth::authenticate()) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token error: ' . $e->getMessage()], 401);
        }
    
        return $next($request);
    }
}

