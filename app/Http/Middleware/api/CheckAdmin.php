<?php

namespace App\Http\Middleware\api;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    const ADMIN = 1;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (JWTAuth::user()->role === self::ADMIN) {
                return $next($request);
            }
        };

        return response()->json([
            'message' => "Bạn không có quyền để thực hiện",
            'status' => 403,
        ]);
    }
}
