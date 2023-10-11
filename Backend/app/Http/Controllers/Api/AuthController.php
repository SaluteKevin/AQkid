<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\UserService;
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

        Log::info($request->all());
        
        if ($request->get('profile_image_path')) {
            return response()->json([
                'access_token' => "ok",
            ]);
        }

        return response()->json([
            'access_token' => "not ok",
        ]);
        
        // $user = new User();
        // $user->username = $request->get('username');
        // $user->password = $request->get('password');
        // $user->role = 'STUDENT';
        // $user->first_name = $request->get('firstname');
        // $user->middle_name = $request->get('middlename');
        // $user->last_name = $request->get('lastname');
        // $user->birthdate = $request->get('birthdate');
        // $user->phone_number = $request->get('phone_number');
        // $user->email = $request->get('email');
        // $user->profile_image_path = "test";
        // $user->save();
        
        Log::info($request->all());

        return $request->all();

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
