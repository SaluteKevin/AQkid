<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Laravel\Sanctum\PersonalAccessToken;
use Phattarachai\LaravelMobileDetect\Agent;
use App\Models\UserSession;

class RequestController extends Controller
{
    public function downServer() {
        
        Artisan::call('down');

        return Artisan::output();

    }

    public function upServer() {
        
        Artisan::call('up');

        return Artisan::output();

    }

    public function quote() {

        Artisan::call('inspire');
        
        return Artisan::output();
    }

    public function storage() {
        Artisan::call('storage:link');
        
        return Artisan::output();
    }

    public function userSession(Request $request) {
        $agent = new Agent();
        $session = new UserSession();
        // $session->user_id = $request->user()->id;
        $session->user_id = auth('sanctum')->user()->id;
        $session->device = $agent->device();
        $session->platform = $agent->platform();
        $session->browser = $agent->browser();
        $session->system = "mobile";
        $session->save();

        return [
            'session' => $session
        ];

    }

    public function loginServer(Request $request) {

        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    
        if ($this->isEmail($request->input('username'))) {
            if (!Auth::validate(['email' => $request->input('username'), 'password' => $request->input('password')])) {
                return [
                    'success' => false,
                ];
            }
            else {
                $user = User::where('email',$request->input('username'))->first();
                return [
                    'success' => true,
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ];


            }
        } else {
            if (!Auth::validate(['username' => $request->input('username'), 'password' => $request->input('password')])) {
                return [
                    'success' => false,
                ];
            }
            else {
                $user = User::where('username',$request->input('username'))->first();
                return [
                    'success' => true,
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ];

            }
        }
        

    }

    public function logoutServer(Request $request) {

        list($tokenId, $token) = explode('|', $request->get('token'));
        $foundToken = PersonalAccessToken::find($tokenId);
        if ($foundToken->delete()) {
            return [
                'success' => true,
            ];
        } 
        return [
            'success' => false,
        ];

    }

    public function isEmail($param) {

        $factory = app(ValidationFactory::class);

        return ! $factory->make(
            ['username' => $param],
            ['username' => 'email']
        )->fails();

    }


}
