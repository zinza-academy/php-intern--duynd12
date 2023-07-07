<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::where('id', $request->id)->first();
        if (session('data')['role'] === \App\Constants\RoleConstants::ADMINISTRATOR) {
            return $next($request);
        }
        if (session('data')['company_id'] === $user['company_id'] && session('data')['role'] !== \App\Constants\RoleConstants::MEMBER) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
