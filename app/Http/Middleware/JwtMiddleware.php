<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use JWTAuth;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return  response()->json(['data'=> null, 'message' => 'Token invalido', 'state' => false, 'satusCode'=> 401], 401);

            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return  response()->json(['data'=> null, 'message' => 'Token expirado', 'state' => false, 'satusCode'=> 401], 401);

            }else{
                return  response()->json(['data'=> null, 'message' => 'No esta autorizado', 'state' => false, 'satusCode'=> 401], 401);
            }
        }
        return $next($request);
    }
}
