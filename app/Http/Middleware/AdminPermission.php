<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // check login
        if (Auth::check()) {
            //check admin permission
            $is_admin = 0;
            foreach (Auth::user()->roles as $role) {
                if ($role->name === 'admin') {
                    $is_admin = 1;
                    break;
                }
            }
            if ($is_admin === 1) {
                return $next($request);
            } else {
                // if don't have permission
                return abort(403);
            }
        }

        return redirect('/admin/login');
    }
}
