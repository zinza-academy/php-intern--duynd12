<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\UserRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            $id = Auth::id();
            $userData = User::with(['roles'])->find($id);
            $nameRole = $userData['roles'][0]['name_role'];

            if($nameRole === 'member'){
                return redirect()->route('403.fobidden');
            }
        };
        return $next($request);
    }
}
