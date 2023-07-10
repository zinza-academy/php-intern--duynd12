<?php

namespace App\Http\Middleware;

use App\Models\Post;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $post = Post::where('id', $request->post)->first();
        if (session('data')['role'] == \App\Constants\RoleConstants::ADMINISTRATOR) {
            return $next($request);
        }
        if ($post->user_id === session('data')['id']) {
            return $next($request);
        }
        abort(403, 'Unauthorized');
    }
}
