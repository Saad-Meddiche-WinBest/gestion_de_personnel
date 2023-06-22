<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\hasPermissionTo;
use Spatie\Permission\Models\Permission;



class mdlacces
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (isset($user) && ($user->hasPermissionTo('*') || $user->hasPermissionTo('acces_to_dashboard')) ) {
            return $next($request);
        } else {
            // Handle the case when the user does not have the required permission
            return redirect('/');
        }
    }
}
