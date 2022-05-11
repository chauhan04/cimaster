<?php

namespace App\Controllers\Frontend;
use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\I18n\Time;

class RegisterController extends BaseController
{
    private $userModel;
    private $viewData;
    private $session;

    public function __construct() {
        $this->userModel = new User();
        $this->session = session();
        $this->viewData = [
            'pageMetaTitle'=>'Sign Up',
            'pageTitle'=> 'Sign Up'
        ];
    }

    public function index()
    {
        $pageTitle = 'Sign Up';
        $userData = [
            'first_name'     => '',
            'last_name'    => '',
            'username'    => '',
            'email'    => '',
            'phone'    => '',
            'password'    => '',
            'address_line1'    => '',
            'address_line2'    => '',
            'country'    => '',
            'state'    => '',
            'city'    => '',
            'zip'    => '',
            'status'    => ''
        ];

        $this->viewData['pageMetaTitle'] = $pageTitle;
        $this->viewData['pageTitle']=$pageTitle;
        $this->viewData['userData']= $userData;

        helper(['form']);        
        echo view('frontend/register', $this->viewData);
    } 
  
    public function register()
    {
        $pageTitle = 'Sign Up';
        $rules = [
            'first_name'          => 'required',
            'last_name'          => 'required',
            'username'      => 'required|min_length[6]|max_length[100]',
            'email'         => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
            'password'         => 'required|min_length[5]|max_length[50]|matches[confirm_password]',
            'confirm_password'         => 'required|min_length[5]|max_length[50]',
            'phone'          => 'required',
            'address_line_1'          => 'required',
            'country_code'          => 'required',
            'state'          => 'required',
            'city'          => 'required',
            'zip'          => 'required'
        ];

        $userData = [
            'first_name'     => $this->request->getVar('first_name'),
            'last_name'    => $this->request->getVar('last_name'),
            'username'    => $this->request->getVar('username'),
            'email'    => $this->request->getVar('email'),
            'phone'    => $this->request->getVar('phone'),
            'password'    => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'address_line1'    => $this->request->getVar('address_line_1'),
            'address_line2'    => $this->request->getVar('address_line_2'),
            'country'    => $this->request->getVar('country_code'),
            'state'    => $this->request->getVar('state'),
            'city'    => $this->request->getVar('city'),
            'zip'    => $this->request->getVar('zip'),
            'status'    => 0,
            'created_at'    => Time::createFromTimestamp(time()),
            'updated_at'    => Time::createFromTimestamp(time())
        ];

        $this->viewData['pageMetaTitle'] = $pageTitle;
        $this->viewData['pageTitle']=$pageTitle;
        $this->viewData['userData']= $userData;
        if($this->validate($rules)) {
            $this->userModel->insert($userData);
            if($this->userModel->affectedRows() != false) {
                 $this->session->setFlashdata('msg', 'You registered successfully.');
                return redirect()->to(route_to("frontend.login"));
            } else {
                $this->session->setFlashdata('err_msg', 'Registration error.');
                return view('frontend/register', $this->viewData);
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
            return view('frontend/register', $this->viewData);
        }        
        
    }

}