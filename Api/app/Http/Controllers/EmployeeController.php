<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Setting;
use App\Models\Settings;
use App\Models\User;
use App\Services\AddressService;
use App\Services\ContactService;
use App\Services\DocumentService;
use App\Services\HttpResponseService;
use App\Services\ImageService;
use App\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{

    public $date;

    public $userModel;
    public $employeeModel;
    public $settingsModel;

    public $addressService;
    public $contactService;
    public $mailService;
    public $imageService;
    public $documentService;

    public function __construct()
    {
        $this->employeeModel = new Employee();
        $this->settingsModel = new Settings();
        $this->userModel = new User();

        $this->addressService = new AddressService();
        $this->contactService = new ContactService();
        $this->mailService = new MailService();
        $this->imageService = new ImageService();
        $this->documentService = new DocumentService();

        $this->date = date('Y-m-d H:i:s');
    }

    public function saveUser(Request $request)
    {
        $user_id = null;

        if ($request['ref']){
            $patch_data = array(
                'username' => $request['username'],
                'password' => Hash::make($request['password']),
                'status' => $request['status'],
                'updated_at' => $this->date,
                'updated_by' => Auth::user()->id,
            );
            $user_id = $this->userModel->updateUser($patch_data);
        }else{
            $patch_data = array(
                'username' => $request['username'],
                'password' => Hash::make($request['password']),
                'status' => 1,
                'created_at' => $this->date,
                'created_by' => Auth::user()->id,
            );
            $user_id = $this->userModel->saveUser($patch_data);
        }

        return $user_id;
    }

    public function saveEmployee(Request $request)
    {
        $credential = $request['credential'];
        $user_id = null;

        //Save & Update Employee Credentials
        if($credential){
            $user_id = $this->saveCredential($credential);
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
            'user_id' => $user_id,
        );

        $addresses = $request['addresses'];
        $contacts = $request['contacts'];
        $mails = $request['mails'];

        if($request['ref']){

            $employee['status'] = $request['status'];
            $employee['updated_at'] = $this->date;
            $employee['updated_by'] = Auth::user()->id;

            $employee_id = $this->employeeModel->updateEmployee($employee);

            //Save Image
            if($request->has('image')){
                $data = array(
                    'who_is' => $employee_id,
                    'who_id' => 0, //0 for employee
                    'image' => $request->file('image'),
                    'folder' => 'employees',
                );
                $image_id = $this->imageService->saveImage($data);
            }
            //Save & Update Addresses
            if($addresses){
                foreach ($addresses as $address){
                    $data = array(
                        'who_is' => 0, //0 for employee
                        'who_id' => $employee_id,
                        'address' => $address,
                    );
                    $address_id = $this->addressService->saveAddress($data);
                }
            }
            //Save & Update Contacts
            if($contacts){
                foreach ($contacts as $contact){
                    $data = array(
                        'who_is' => 0, //0 for employee
                        'who_id' => $employee_id,
                        'contact' => $contact,
                    );
                    $contact_id = $this->contactService->saveContact($data);
                }
            }
            //Save & Update Mails
            if($mails){
                foreach ($mails as $mail){
                    $data = array(
                        'who_is' => 0, //0 for employee
                        'who_id' => $employee_id,
                        'mail' => $mail,
                    );
                    $mail_id = $this->mailService->saveMail($data);
                }
            }
            return HttpResponseService::successReturn([],'Employee Updated Successfully');
        }else{

            $employee['status'] = 1;
            $employee['created_at'] = $this->date;
            $employee['created_by'] = Auth::user()->id;

            $employee_id = $this->employeeModel->saveEmployee($employee);

            //Save Image
            if($request->has('image')){
                $data = array(
                    'who_is' => $employee_id,
                    'who_id' => 0, //0 for employee
                    'image' => $request->file('image'),
                    'folder' => 'employees',
                );
                $image_id = $this->imageService->saveImage($data);
            }
            //Save & Update Addresses
            if($addresses){
                foreach ($addresses as $address){
                    $data = array(
                        'who_is' => 0, //0 for employee
                        'who_id' => $employee_id,
                        'address' => $address,
                    );
                    $address_id = $this->addressService->saveAddress($data);
                }
            }
            //Save & Update Contacts
            if($contacts){
                foreach ($contacts as $contact){
                    $data = array(
                        'who_is' => 0, //0 for employee
                        'who_id' => $employee_id,
                        'contact' => $contact,
                    );
                    $contact_id = $this->contactService->saveContact($data);
                }
            }
            //Save & Update Mails
            if($mails){
                foreach ($mails as $mail){
                    $data = array(
                        'who_is' => 0, //0 for employee
                        'who_id' => $employee_id,
                        'mail' => $mail,
                    );
                    $mail_id = $this->mailService->saveMail($data);
                }
            }
            return HttpResponseService::successReturn([],'Employee Saved Successfully');
        }
        return HttpResponseService::errorReturn([],'Registration Failed',102);
    }


}
