<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
}


// <?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class Authenticate
// {
//     /**
//      * Get the path the user should be redirected to when they are not authenticated.
//      */
//     public function handle($request, Closure $next)
//     {
//         if (!Auth::check()) {
//             return redirect()->route('login');
//         }

//         return $next($request);
//     }
// }
