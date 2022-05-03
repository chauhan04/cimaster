<?php

namespace App\Controllers\Frontend;
use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\I18n\Time;

class UserController extends BaseController
{
    private $userModel;
    private $session;
    private $viewData;

    public function __construct() {
        $this->userModel = new User();
        $this->session = session();
        $this->viewData = [
            'pageMetaTitle'=>'Users',
            'pageTitle'=> 'Users'
        ];
    }

    public function index()
    {
        $pageTitle = 'Dashboard';
        $this->viewData['pageMetaTitle'] = $pageTitle;
        $this->viewData['pageTitle']=$pageTitle; 
        return view('frontend/dashboard', $this->viewData);
    }

    public function profile()
    {
        $userId = session('id');
        $pageTitle = 'Profile';
        $userData = $this->userModel->getUserById($userId);
        $this->viewData['pageMetaTitle'] = $pageTitle;
        $this->viewData['pageTitle']=$pageTitle;
        $this->viewData['userData']= $userData;   
        return view('frontend/users/profile', $this->viewData);
    }

    public function editProfile()
    {
        $userId = session('id');
        $pageTitle = 'Edit Profile';
        $userData = $this->userModel->getUserById($userId);
        $this->viewData['pageMetaTitle'] = $pageTitle;
        $this->viewData['pageTitle']=$pageTitle;
        $this->viewData['userData']= $userData;    
        return view('frontend/users/editprofile', $this->viewData);
    }

    public function saveProfile()
    {
        $pageTitle = 'Users';
        $rules = [
            'first_name'          => 'required',
            'last_name'          => 'required',
            'username'      => 'required|min_length[6]|max_length[100]',
            'email'         => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email,id,{id}]',
            'phone'          => 'required',
            'address_line_1'          => 'required',
            'country_code'          => 'required',
            'state'          => 'required',
            'city'          => 'required',
            'zip'          => 'required'
        ];

        /*
        if(trim($this->request->getVar('password')) != ''){
            $rules['password'] = 'required|min_length[5]|max_length[50]|matches[confirm_password]';
            $rules['confirm_password'] = 'required|min_length[5]|max_length[50]';
        }
        */

        if($this->validate($rules)){
            $userId = session('id');
            
            $userData = [
                'first_name'     => $this->request->getVar('first_name'),
                'last_name'    => $this->request->getVar('last_name'),
                'username'    => $this->request->getVar('username'),
                'email'    => $this->request->getVar('email'),
                'phone'    => $this->request->getVar('phone'),
                'address_line1'    => $this->request->getVar('address_line_1'),
                'address_line2'    => $this->request->getVar('address_line_2'),
                'country'    => $this->request->getVar('country_code'),
                'state'    => $this->request->getVar('state'),
                'city'    => $this->request->getVar('city'),
                'zip'    => $this->request->getVar('zip'),
                'status'    => $this->request->getVar('status'),
                'updated_at'    => Time::createFromTimestamp(time())
            ];

            $this->viewData['pageMetaTitle'] = $pageTitle;
            $this->viewData['pageTitle']=$pageTitle;
            $this->viewData['userData']= $userData;
            /*if(trim($this->request->getVar('password')) != ''){
                $userData['passwprd'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
            }*/

            if($this->userModel->update($userId, $userData) === true) {
                 $this->session->setFlashdata('msg', 'Profile updated successfully.');
                return redirect()->to(route_to("user.profile"));
            } else {
                $this->session->setFlashdata('err_msg', 'Profile update error.');
                $pageTitle = 'User Profile';
                return view('frontend/users/editprofile', $this->viewData);
            }
                        
        } else {
            $validationErrors = '';
            $validation = $this->validator->getErrors();
            if(!empty($validation)) {
                foreach($validation as $err_msg) {
                    $validationErrors .= $err_msg;
                }
            }
            if(!empty($validationErrors)) {
                $this->session->setFlashdata('err_msg', $validationErrors);
            }
            return redirect()->to(route_to("user.profile.edit"));
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(route_to("frontend.login"));
    }

    public function changepassword()
    {
        $pageTitle = 'Change Password';
        $this->viewData['pageMetaTitle'] = $pageTitle;
        $this->viewData['pageTitle']=$pageTitle;   
        return view('frontend/users/changepassword', $this->viewData);
    }

    public function changepasswordsave()
    {
        $pageTitle = 'Change Password';
        $this->viewData['pageMetaTitle'] = $pageTitle;
        $this->viewData['pageTitle']=$pageTitle;

        $rules['current_password'] = 'required|min_length[5]|max_length[50]';
        $rules['password'] = 'required|min_length[5]|max_length[50]|matches[confirm_password]';
        $rules['confirm_password'] = 'required|min_length[5]|max_length[50]';

        if($this->validate($rules)){
            $current_password = $this->request->getVar('current_password');
            $userId = session('id');
            $userData = $this->userModel->getUserById($userId);
            $pass = $userData['password'];
            $authenticatePassword = password_verify($current_password, $pass);
            if($authenticatePassword) {
                $userData = [
                    'password'    => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'updated_at'    => Time::createFromTimestamp(time())
                ];

                if($this->userModel->update($userId, $userData) === true) {
                    $this->session->setFlashdata('msg', 'Password updated successfully.');
                    return redirect()->to(route_to("user.changepassword"));
                } else {
                    $this->session->setFlashdata('err_msg', 'Password update error.');
                    return view('frontend/users/editprofile', $this->viewData);
                }
            } else {
                $session->setFlashdata('err_msg', 'Your current password is incorrect.');
                return redirect()->to(route_to("user.changepassword"));
            }            
        } else {
            $validationErrors = '';
            $validation = $this->validator->getErrors();
            if(!empty($validation)) {
                foreach($validation as $err_msg) {
                    $validationErrors .= $err_msg;
                }
            }
            if(!empty($validationErrors)) {
                $this->session->setFlashdata('err_msg', $validationErrors);
            }
            return redirect()->to(route_to("user.changepassword"));
        }

        return view('frontend/users/changepassword', $this->viewData);
    }
}