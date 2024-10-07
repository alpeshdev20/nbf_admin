<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Closure  $next
     * @param  int  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // Check if the user is authenticated and their access role matches
        if (Auth::check() && Auth::user()->access->access_role == $role) {
            return $next($request);
        }

        // Redirect or return an error response if the role does not match
        return redirect('/home');    }
}