<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;


class AuthController extends Controller
{
    public function loginServer(LoginRequest $request) {

        UserService::getUserManager()->login($request);

        return UserService::getUserManager()->generateApiToken($request);

        


    
        // if ($this->isEmail($request->input('username'))) {
        //     if (!Auth::validate(['email' => $request->input('username'), 'password' => $request->input('password')])) {
        //         return [
        //             'success' => false,
        //         ];
        //     }
        //     else {
        //         $user = User::where('email',$request->input('username'))->first();
        //         return [
        //             'success' => true,
        //             'token' => $user->createToken("postman",['staff'])->plainTextToken
        //         ];


        //     }
        // } else {
        //     if (!Auth::validate(['username' => $request->input('username'), 'password' => $request->input('password')])) {
        //         return [
        //             'success' => false,
        //         ];
        //     }
        //     else {
        //         $user = User::where('username',$request->input('username'))->first();
        //         return [
        //             'success' => true,
        //             'token' => $user->createToken("postman",['staff'])->plainTextToken
        //         ];

        //     }
        // }
        

    }

    public function isEmail($param) {

        $factory = app(ValidationFactory::class);

        return ! $factory->make(
            ['username' => $param],
            ['username' => 'email']
        )->fails();

    }
}
