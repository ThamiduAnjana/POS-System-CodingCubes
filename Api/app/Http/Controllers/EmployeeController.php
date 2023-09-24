<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Settings;
use App\Services\AddressService;
use App\Services\ContactService;
use App\Services\DocumentService;
use App\Services\HttpResponseService;
use App\Services\ImageService;
use App\Services\MailService;
use App\Services\SettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{

    private $date;

    private $employeeModel;
    private $settingsModel;

    private $addressService;
    private $contactService;
    private $mailService;
    private $imageService;
    private $documentService;
    private $settingsService;

    public function __construct()
    {
        $this->employeeModel = new Employee();
        $this->settingsModel = new Settings();

        $this->addressService = new AddressService();
        $this->contactService = new ContactService();
        $this->mailService = new MailService();
        $this->imageService = new ImageService();
        $this->documentService = new DocumentService();
        $this->settingsService = new SettingsService();

        $this->date = date('Y-m-d H:i:s');
    }

    public function saveEmployee(Request $request)
    {
        if($request->all()){
            return HttpResponseService::error([],'Registration Failed',Response::HTTP_BAD_REQUEST);
        }

        $employee = array(
            'first_name' => $request['first_name'],
            'middle_name' => $request['middle_name'],
            'last_name' => $request['last_name'],
            'initials' => $request['initials'],
            'sex' => $request['sex'],
            'nic' => $request['nic'],
            'passport' => $request['passport'],
            'driving_license' => $request['driving_license'],
            'dob' => $request['dob'],
            'basic_salary' => $request['basic_salary'],
            'fixed_allowance' => $request['fixed_allowance'],
            'food_allowance' => $request['food_allowance'],
            'transport_allowance' => $request['transport_allowance'],
            'commission_rate' => $request['commission_rate'],
            'ot_rate' => $request['ot_rate'],
            'insurance' => $request['insurance'],
            'epf_rate' => $request['epf_rate'],
            'etf_rate' => $request['etf_rate'],
            'stamp_duty' => $request['stamp_duty'],
            'salary_type_id' => $request['salary_type_id'],
            'emp_type_id' => $request['emp_type_id'],
            'department_id' => $request['department_id'],
            'username' => $request['username'],
            'password' => Hash::make($request['password']),
        );

        $addresses = $request['addresses'];
        $contacts = $request['contacts'];
        $mails = $request['mails'];

        if($request['ref']){

            $employee['status'] = $request['status'];
            $employee['updated_at'] = $this->date;
            $employee['updated_by'] = Auth::user()->id;

            $employee_id = $this->employeeModel->updateEmployee($employee,array('ref' => $request['ref']));

            //Save Image
            if($request->has('image')){
                $data = array(
                    'owner_type' => 1, //1 for employee
                    'owner_id' => $employee_id,
                    'image' => $request->file('image'),
                    'folder' => 'employees',
                );
                $image_id = $this->imageService->saveImage($data);
            }
            //Save & Update Addresses
            if($addresses){
                foreach ($addresses as $address){
                    $data = array(
                        'owner_type' => 1, //1 for employee
                        'owner_id' => $employee_id,
                        'address' => $address,
                    );
                    $address_id = $this->addressService->saveAddress($data);
                }
            }
            //Save & Update Contacts
            if($contacts){
                foreach ($contacts as $contact){
                    $data = array(
                        'owner_type' => 1, //1 for employee
                        'owner_id' => $employee_id,
                        'contact' => $contact,
                    );
                    $contact_id = $this->contactService->saveContact($data);
                }
            }
            //Save & Update Mails
            if($mails){
                foreach ($mails as $mail){
                    $data = array(
                        'owner_type' => 1, //1 for employee
                        'owner_id' => $employee_id,
                        'mail' => $mail,
                    );
                    $mail_id = $this->mailService->saveMail($data);
                }
            }
            return HttpResponseService::success([],'Employee Updated Successfully');
        }else{

            $employee['status'] = 1;
            $employee['created_at'] = $this->date;
            $employee['created_by'] = Auth::user()->id;

            $employee_id = $this->employeeModel->saveEmployee($employee);

            //Save Image
            if($request->has('image')){
                $data = array(
                    'owner_type' => $employee_id,
                    'owner_id' => 1, //1 for employee
                    'image' => $request->file('image'),
                    'folder' => 'employees',
                );
                $image_id = $this->imageService->saveImage($data);
            }
            //Save & Update Addresses
            if($addresses){
                foreach ($addresses as $address){
                    $data = array(
                        'owner_type' => 1, //1 for employee
                        'owner_id' => $employee_id,
                        'address' => $address,
                    );
                    $address_id = $this->addressService->saveAddress($data);
                }
            }
            //Save & Update Contacts
            if($contacts){
                foreach ($contacts as $contact){
                    $data = array(
                        'owner_type' => 1, //1 for employee
                        'owner_id' => $employee_id,
                        'contact' => $contact,
                    );
                    $contact_id = $this->contactService->saveContact($data);
                }
            }
            //Save & Update Mails
            if($mails){
                foreach ($mails as $mail){
                    $data = array(
                        'owner_type' => 1, //1 for employee
                        'owner_id' => $employee_id,
                        'mail' => $mail,
                    );
                    $mail_id = $this->mailService->saveMail($data);
                }
            }
            return HttpResponseService::success([],'Employee Saved Successfully');
        }
        return HttpResponseService::error([],'Registration Failed',Response::HTTP_PRECONDITION_FAILED);
    }

    public function login(Request $request)
    {
        $credential = Validator::make($request->only(['username', 'password']), [
            'username' => 'required',
            'password' => 'required|string',
        ]);

        if ($credential->fails()) {
            return HttpResponseService::error($credential->errors(), 'Unprocessable Entity!',Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $employee = $this->employeeModel->getEmployeeByWhere(['username' => $request['username'],'status' => 1]);

        if($employee){
            if (!$token = Auth::attempt($credential->validated())) {
                return HttpResponseService::error([], 'Unauthorized!',Response::HTTP_UNAUTHORIZED);
            }
            return $this->respondWithToken($token);
        }
        return HttpResponseService::error([], 'Your account is deactivated!',Response::HTTP_UNAUTHORIZED);
    }

    public function handleEmployeeDetailsWhenLogin($data)
    {
        return array([
            'id' => $data['id'],
            'full_name' => $data['title'].' '.$data['initials'].' '.$data['first_name'].' '.$data['middle_name'].' '.$data['last_name'],
            'title' => $data['title'],
            'initials' => $data['initials'],
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
        ]);
    }

    protected function respondWithToken($token)
    {
        $filters = [
            'resource_id' => 1,
            'status' => 1
        ];

//        $settings = $this->settingsModel->getSettingsByWhere($filters);
//        $system_settings = $this->settingsService->handleSettings((array)$settings);


        return  HttpResponseService::success([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => $this->handleEmployeeDetailsWhenLogin(Auth::user()),
            'settings' => $system_settings ?? [],
        ], 'Login successfully!', Response::HTTP_OK);
    }

    public function logout()
    {
        Auth::logout();
        return HttpResponseService::success([],'Successfully logged out');
    }

    public function me()
    {
        return HttpResponseService::success([],'User Details',Auth::user());
    }

    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

}
