<?php

namespace App\Managers;

use App\Models\User;
use App\Models\UserSession;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Phattarachai\LaravelMobileDetect\Agent;
use App\Exceptions\CustomException;
use App\Models\PasswordResetToken;
use App\Services\MailService;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;


class UserManager {

    public function __construct() {}

    public function login(LoginRequest $loginRequest) {

        $loginRequest->authenticate();

    }

    public function createSession() {

        $agent = new Agent();

        if (UserSession::where('device', $agent->device())->where('browser',$agent->browser())->first() != null) {
            
            if (UserSession::where('user_id', Auth::getUser()->id)->where('device', $agent->device())->where('browser',$agent->browser())->first() != null) {
                
                return true;

            }
            
            $session = UserSession::where('device', $agent->device())->where('browser',$agent->browser())->first();
            $session->user_id = Auth::getUser()->id;
            $session->created_at = Carbon::now();
            
            if ($session->save()) {
                return true;
            }

            throw new CustomException("Can't generate your session", 302);

            
        }

        else {

            $session = new UserSession();
            $session->user_id = Auth::getUser()->id;
            $session->device = $agent->device();
            $session->platform = $agent->platform();
            $session->browser = $agent->browser();

            if ($agent->isMobile()) {
                $session->system = "mobile";
                
                if ($session->save()) {
                    return true;
                
                }

                throw new CustomException("Can't generate your session", 302);
            }

            $session->system = "desktop";
            if ($session->save()) {
                return true;
            }
            
            throw new CustomException("Can't generate your session", 302);

        }

    }

    public function logout(Request $request) {

        $agent = new Agent();
        
        $activeSession = UserSession::where('user_id', Auth::getUser()->id)->where('device', $agent->device())->where('browser',$agent->browser())->first();

        if ($activeSession != null) {

            // Mark the session as invalidated by setting invalidated_at column for log if you want later
            if ($activeSession->delete() && (Auth::logout() == null)) {

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return true;

            }

            

        }

        throw new CustomException("Failed to logout.", 302);

        
    
    }

    public function verifyUser($userId) {

        $user = User::find($userId);
        $user->email_verified_at = Carbon::now();
        
        if ($user->save()) {
            return true;
        }

        throw new CustomException("Can't verify your email.", 302, route('login'));



    }

    public function forgotPassword(Request $request) {

        if ($this->isEmail($request->get('email'))) {
            
            $user = User::where('email',$request->get('email'))->first();
            
            if ($user != null) {

                if ($user->email_verified_at != null) {
                    //sent mail

                    MailService::getMailManager()->sendResetPasswordMail($user->email);

                    return true;
                }

                throw new CustomException("Oops, Sorry your account email is not verify.", 302);

            }

            throw new CustomException("Oops, Sorry we can't find your email account.", 302);

        }

        else {

            $user = User::where('username',$request->get('email'))->first();
            
            if ($user != null) {

                if ($user->email_verified_at != null) {
                    //sent mail

                    MailService::getMailManager()->sendResetPasswordMail($user->email);

                    return true;
                }

                throw new CustomException("Oops, Sorry your account email is not verify.", 302);

            }

            throw new CustomException("Oops, Sorry we can't find your username account.", 302);

        }

    }

    public function isEmail($param) {

        $factory = app(ValidationFactory::class);

        return ! $factory->make(
            ['username' => $param],
            ['username' => 'email']
        )->fails();

    }

    // public function validatePasswordResetToken($token) {

    //     $token = PasswordResetToken::where('token', $token)->first();

    //     if ($token != null) {
    //         return true;
    //     }
        
    //     throw new CustomException("Oops, It looks like your token has expired.", 302, route('login'));



    // }

    public function resetPassword(Request $request, $token) {
        
        $token = PasswordResetToken::where('token', $token)->first();

        if ($token != null) {

            $user = User::where('email', $token->email)->first();

            if ($user != null) {

                $user->password = $request->get('password');
                
                if ($user->save()) {
                    return true;
                }

                throw new CustomException("Oops, It looks like there is a problem in process of reset your password.", 302);

            }

            throw new CustomException("Oops, Sorry We can't find your account.", 302, route('login'));
            
        }
        
        throw new CustomException("Oops, It looks like your token has expired.", 302, route('login'));


    }

    public function removePasswordResetToken($token) {
        
        $token = PasswordResetToken::where('token', $token)->first();

        if ($token != null) {

            if ($token->delete()) {

                return true;

            }

            throw new CustomException("Oops, It looks like there is a problem in process of reset your password.", 302);
            

        }

        throw new CustomException("Oops, It looks like your token has expired.", 302, route('login'));

    }
    


}