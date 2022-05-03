<?php

namespace App\Controllers\Backend;
use App\Controllers\BaseController;
use App\Models\Admin;

class LoginController extends BaseController
{
    private $adminModel;
    private $viewData;

    public function __construct() {
        $this->adminModel = new Admin();
        $this->viewData = [
            'pageMetaTitle'=>'Sign In',
            'pageTitle'=> 'Sign In'
        ];
    }

    public function index()
    {
        helper(['form']);        
        echo view('backend/login', $this->viewData);
    } 
  
    public function loginAuth()
    {
        $session = session();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        $data = $this->adminModel->where('email', $email)->first();
        
        if($data) {

            $pass = $data['password'];

            $authenticatePassword = password_verify($password, $pass);
            if($authenticatePassword) {
                $ses_data = [
                    'id' => $data['id'],
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'full_name' => $data['first_name'].' '.$data['last_name'],
                    'email' => $data['email'],
                    'username' => $data['username'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to(route_to("admin.dashboard"));
            
            } else {
                $session->setFlashdata('err_msg', 'Password is incorrect.');
                return redirect()->to(route_to("admin.login"));
            }
        } else {
            $session->setFlashdata('err_msg', 'Email does not exist.');
            return redirect()->to(route_to("admin.login"));
        }
    }

}