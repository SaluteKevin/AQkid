<?php

namespace App\Managers;

use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;
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



    public function isEmail($param) {

        $factory = app(ValidationFactory::class);

        return ! $factory->make(
            ['username' => $param],
            ['username' => 'email']
        )->fails();

    }

    
    


}