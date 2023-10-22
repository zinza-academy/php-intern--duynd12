<?php

namespace App\Http\Middleware\api;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class Company
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::where('id', $request->id)->first();
        $role = JWTAuth::user()->role;
        $companyId = JWTAuth::user()->company_id;
        if ($role === \App\Constants\RoleConstants::ADMINISTRATOR) {
            return $next($request);
        }
        if ($companyId === $user['company_id'] && $role !== \App\Constants\RoleConstants::MEMBER) {
            return $next($request);
        }

        return response()->json([
            'message' => "Bạn không có quyền để thực hiện",
            'status' => 403
        ]);
    }
}
