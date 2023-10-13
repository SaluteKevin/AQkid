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

        $user = new User();
        $user->username = $request->get('username');
        $user->password = $request->get('password');
        $user->role = 'STUDENT';
        $user->first_name = $request->get('firstname');
        $user->middle_name = $request->get('middlename');
        $user->last_name = $request->get('lastname');
        $user->birthdate = $request->get('birthdate');
        $user->phone_number = $request->get('phone_number');
        $user->email = $request->get('email');

        $file = $request->file('profile_image_path');

        $image_path = FileService::getFileManager()->uploadFile('users/' . $user->username . "/" ."profile.jpg",$file);

        if ( $image_path != false ) {

            $user->profile_image_path = $image_path;

            if ( $user->save() ) {

                return response()->json([
                    'message' => "Successfully created User",
                ]);

            }

            return response()->json([
                'message' => "Failed to create User",
            ], 422);

        }

        $image_path = "default";
        $user->profile_image_path = $image_path;
        
        if ( $user->save() ) {

            return response()->json([
                'message' => "Successfully created User",
            ]);

        }

        return response()->json([
            'message' => "Failed to create User",
        ], 422);
        
    
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
