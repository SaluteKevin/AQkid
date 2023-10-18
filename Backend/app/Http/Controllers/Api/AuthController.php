<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\UserService;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Enums\UserRoleEnum;



class AuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {

        $request->authenticate();

        $token = UserService::getUserManager()->generateApiToken($request);

        return $this->respondWithToken($token);

    }

    public function register(Request $request)
    {

        $request->validate([
            'username' => 'required|max:255',
            'password' => 'required|confirmed|min:6',
            'firstname' => 'required',
            'middlename' => 'nullable',
            'lastname' => 'required',
            'birthdate' => 'required',
            'phone_number' => 'required',
            'email' => 'nullable',
        ]);
        
        $statusOk = User::createUser($request->get('username'), $request->get('password'), UserRoleEnum::STUDENT,
                                     $request->get('firstname'), $request->get('middlename'), $request->get('lastname'),
                                     $request->get('birthdate'), $request->get('phone_number'), $request->get('email'),
                                     $request->file('profile_image_path'));

        

        if ( $statusOk != false ) {

            return response()->json([
                'message' => "Successfully created User",
            ]);

        }

        return response()->json([
            'message' => "Failed to create User",
        ],422);
        
    
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }


}
