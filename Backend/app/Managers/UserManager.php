<?php

namespace App\Managers;

use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\PasswordResetToken;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Services\MailService;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;


class UserManager {

    public function __construct() {}

    public function generateApiToken(LoginRequest $request) {

        if ($this->isEmail($request->input('username'))) {
        
            $token = JWTAuth::attempt(['email' => $request->get('username'),'password' => $request->get('password')]);

            return $token;

        
        }

        $token = JWTAuth::attempt(['username' => $request->get('username'),'password' => $request->get('password')]);


        return $token;
        

    }


    public function verifyUser($userId) {

        $user = User::find($userId);
        $user->email_verified_at = Carbon::now();
        
        if ($user->save()) {
            return true;
        }

        return response()->json(['message' => "Can't verify your email."], 422);



    }

    public function forgotPassword(Request $request) {

        if ($this->isEmail($request->get('email'))) {
            
            $user = User::where('email',$request->get('email'))->first();
            
            if ($user != null) {

                if ($user->email_verified_at != null) {
                    //sent mail

                    MailService::getMailManager()->sendResetPasswordMail($user->email);

                    return response()->json(['message' => "We have sent you a ResetPassword Email"]);
                }

                return response()->json(['message' => "Oops, Sorry your account email is not verify."], 422);


            }

            return response()->json(['message' => "Oops, Sorry we can't find your email account."], 422);

        }

        else {

            $user = User::where('username',$request->get('email'))->first();
            
            if ($user != null) {

                if ($user->email_verified_at != null) {
                    //sent mail

                    MailService::getMailManager()->sendResetPasswordMail($user->email);

                    return response()->json(['message' => "We have sent you a ResetPassword Email"]);
                }

                return response()->json(['message' => "Oops, Sorry your account email is not verify."], 422);

            }

            return response()->json(['message' => "Oops, Sorry we can't find your username account."], 422);

        }

    }

    public function isEmail($param) {

        $factory = app(ValidationFactory::class);

        return ! $factory->make(
            ['username' => $param],
            ['username' => 'email']
        )->fails();

    }

    public function resetPassword(Request $request, $token) {
        
        $token = PasswordResetToken::where('token', $token)->first();

        if ($token != null) {

            $user = User::where('email', $token->email)->first();

            if ($user != null) {

                $user->password = $request->get('password');
                
                if ($user->save()) {
                    return true;
                }

                return response()->json(['message' => "Oops, It looks like there is a problem in process of reset your password."], 422);

            }

            return response()->json(['message' => "Oops, Sorry We can't find your account."], 422);
            
        }
        
        return response()->json(['message' => "Oops, It looks like your token has expired."], 422);


    }

    public function removePasswordResetToken($token) {
        
        $token = PasswordResetToken::where('token', $token)->first();

        if ($token != null) {

            if ($token->delete()) {

                return true;

            }

            return response()->json(['message' => "Oops, It looks like there is a problem in process of reseting your password."], 422);
            

        }

        return response()->json(['message' => "Oops, It looks like your token has expired."], 422);

    }
    


}