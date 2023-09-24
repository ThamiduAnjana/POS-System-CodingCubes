<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Settings;
use App\Services\SettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    private $employeeModel;
    private $settingsModel;

    private $settingsService;

    public function __construct()
    {
        $this->employeeModel = new Employee();
        $this->settingsModel = new Settings();

        $this->settingsService = new SettingsService();
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return Controller::error($validator->errors(), 'Unprocessable Entity!',Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if (!$token = Auth::attempt($validator->validated())) {
            return Controller::error([], 'Unauthorized!',Response::HTTP_UNAUTHORIZED);
        }
        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        $filters = [
            'resource_id' => 1,
            'status' => 1
        ];

        $settings = $this->settingsModel->getSettingsByWhere($filters);
        $system_settings = $this->settingsService->handleSettings((array)$settings);

        return  Controller::success([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => $this->employeeModel->getUser(['id' => Auth::user()->id]),
            'settings' => $system_settings
        ], 'Login successfully!', Response::HTTP_OK);
    }
}
