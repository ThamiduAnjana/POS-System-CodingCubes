<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Models\User;
use App\Services\HttpResponseService;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public $userModel;
    public $settingModel;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);

        $this->userModel = new User();
        $this->settingModel = new Settings();
    }

    public function login()
    {
        $credentials = request(['username', 'password']);

        $user = $this->userModel->getUserWhere(['username' => request('username'), 'status' => 1]);

        if($user){
            if (! $token = auth()->attempt($credentials)) {
                return Controller::errorReturn([],'Unauthorized',401);
            }
            return $this->respondWithToken($token);
        }else{
            return Controller::errorReturn(['error' => 'Your account is deactivated.'], 201);
        }
    }

    public function me()
    {
        return Controller::successReturn(auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return Controller::successReturn([],'Successfully logged out');
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
//        $settings = $this->settingsModel->getSettings();

        return Controller::successReturn([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 60000,
            'user' => auth()->user(),
//            'settings' => $settings
        ]);
    }
}
