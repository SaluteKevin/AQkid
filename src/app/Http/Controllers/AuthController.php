<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Services\MailService;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{   

    public function getLoginPage(){
        return view('auth.login');
    }

    public function getPage() {
        return view('welcome');
    }

    public function getForgotPage() {
        return view('auth.forgot-password');
    }

    public function getResetPage($token) {
        return view('auth.reset-password',['token' => $token]);
    }


    // public function testInertia() {
    //     return Inertia::render('test/Show');
    // }

    // Login
    public function login(LoginRequest $loginRequest) {
        
        // try login
        UserService::getUserManager()->login($loginRequest);

        // save session
        UserService::getUserManager()->createSession($loginRequest);

        // send mail
        // MailService::getMailManager()->sendWelcomeMail();
        
        

        if (Auth::check() && Auth::getUser()->role == "admin") {
            return redirect()->route('welcome');
        }

        if (Auth::check() && Auth::getUser()->role == "user") {
            return redirect()->route('welcome');
        }
        


    }

    public function logout(Request $request) {

        // logout 
        UserService::getUserManager()->logout($request);

        return redirect()->route('login')->with('message', 'You have been logged out.');

    }

    public function verifyUser($userId) {

        UserService::getUserManager()->verifyUser($userId);
            
        return redirect()->route('login')->with('message', 'You have verified Your Email.');
        

    }

    public function forgotPassword(Request $request) {

        $request->validate([
            'email' => 'required|string'
        ]);

        UserService::getUserManager()->forgotPassword($request);

        return redirect()->route('login')->with('message', 'We have sent you a reset Link');
    }

    public function resetPassword(Request $request, $token) {
        
        // validate
        $request->validate([
            'password' => 'required|confirmed'
        ]);

        //reset password
        UserService::getUserManager()->resetPassword($request, $token);

        //remove tokens
        UserService::getUserManager()->removePasswordResetToken($token);

        return redirect()->route('login')->with('message', 'You have succesfully reset your password.');


    }

    public function axios(Request $request) {
        
        $request->validate([
            'key1' => 'required|string',
            'key2' => 'required|string',
        ]);
        
        return $request->all();
        // $data = $request->all();
        // $data['key1'];
        // $data = $request->get('key1');
        // return $data;
    }
}
