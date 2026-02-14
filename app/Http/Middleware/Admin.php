<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

    $user = User::join('roles', 'roles.id', 'users.role_id')->where('users.is_deleted', 'N')
    ->where('users.id', Auth::user()->id)->select('roles.slug')->first();

        if (!Auth::check() || $user->slug !=  'admin') {
             abort(403);
        }
        return $next($request);
    }
}
