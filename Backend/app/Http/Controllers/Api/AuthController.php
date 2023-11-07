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
            'username' => 'required|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'firstname' => 'required',
            'middlename' => 'nullable',
            'lastname' => 'required',
            'birthdate' => 'required|'.'before_or_equal:' . now()->format('Y-m-d'),
            'phone_number' => 'required',
            'email' => 'nullable|unique:users',
            'profile_image_path' => 'nullable|image|mimes:png,gif,jpg,jpeg,bmp|max:2048'
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

    public function updateProfile(User $user, Request $request)
    {

        $request->validate([
            'firstname' => 'required',
            'middlename' => 'nullable',
            'lastname' => 'required',
            'birthdate' => 'required|'.'before_or_equal:' . now()->format('Y-m-d'),
            'phone_number' => 'required',
            'email' => 'nullable|unique:users',
        ]);

        $statusOk = User::updateUserInfo(
            $user,
            $request->get('firstname'),
            $request->get('middlename'),
            $request->get('lastname'),
            $request->get('birthdate'),
            $request->get('phone_number'),
            $request->get('email')
        );

        if ($statusOk) {
            return response()->json([
                'message' => "Successfully Updated User",
            ]);
        }

        return response()->json([
            'message' => "Failed to Update User",
        ], 422);
    }

    public function updatePassword(User $user, Request $request)
    {

        $request->validate(['password' => 'required|confirmed|min:6']);

        $statusOk = User::changeUserPassword($user, $request->get('password'));

        if ($statusOk) {
            return response()->json([
                'message' => "Successfully Updated Password",
            ]);
        }

        return response()->json([
            'message' => "Failed to Update Password",
        ], 422);
    }

    public function updateImage(User $user, Request $request)
    {

        $request->validate(['profile_image_path' => 'nullable|image|mimes:png,gif,jpg,jpeg,bmp|max:2048']);

        $statusOk = User::changeProfileImage($user, $request->file('profile_image_path'));

        if ($statusOk) {
            return response()->json([
                'message' => "Successfully Updated Profile Image",
            ]);
        }

        return response()->json([
            'message' => "Failed to Update Profile Image",
        ], 422);
    }


}
