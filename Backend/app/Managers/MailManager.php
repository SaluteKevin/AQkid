<?php

namespace App\Managers;

use App\Models\User;
use App\Models\PasswordResetToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendWelcomeEmail;
use App\Jobs\SendResetPasswordEmail;
use App\Exceptions\CustomException;



class MailManager {

    public function __construct() {}

    public function sendWelcomeMail() {
        
        SendWelcomeEmail::dispatch(Auth::getUser()->id);

    }

    public function sendResetPasswordMail($email) {

        if (PasswordResetToken::where('email',$email)->first() != null) {

            $token = PasswordResetToken::where('email',$email)->first();

            $gen = bin2hex(random_bytes(16));
            while (PasswordResetToken::where('token',$gen)->first() != null) {
                $gen = bin2hex(random_bytes(16));
            }

            $token->token = $gen;

            if ($token->save()) {
                
                SendResetPasswordEmail::dispatch($token->id);

                return true;
            }

            throw new CustomException("Oops, Sorry there is a problem in sending the reset password email link.", 302);

        }

        $token = new PasswordResetToken();
        $token->email = $email;

        $gen = bin2hex(random_bytes(16));
        while (PasswordResetToken::where('token',$gen)->first() != null) {
            $gen = bin2hex(random_bytes(16));
        }

        $token->token = $gen;

        if ($token->save()) {
                
            SendResetPasswordEmail::dispatch($token->id);

            return true;
        }

        throw new CustomException("Oops, Sorry there is a problem in sending the reset password email link.", 302);

    }


}