<?php

namespace App\Http\Middleware\api;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class UserCreatedPost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $post = Post::where('id', $request->id)->first();

        if (JWTAuth::user()->role == \App\Constants\RoleConstants::ADMINISTRATOR) {
            return $next($request);
        }
        if ($post->user_id === JWTAuth::user()->id) {
            return $next($request);
        }

        return response()->json([
            'message' => "Bạn không có quyền để thực hiện",
            'status' => 403
        ]);
    }
}
