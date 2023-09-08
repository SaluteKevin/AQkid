<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserSession;
use Phattarachai\LaravelMobileDetect\Agent;

class EnsureSessionIsNotInvalidated
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle($request, Closure $next) {

        $user = Auth::getUser();
        $agent = new Agent();

        if (UserSession::where('user_id', $user->id)
                    ->where('device', $agent->device())
                    ->where('browser',$agent->browser())
                    ->doesntExist() ){

            return redirect()->route('login');
        }

        
        
        return $next($request);

    }
}
