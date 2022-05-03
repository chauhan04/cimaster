<?php

namespace App\Controllers\Backend;
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
        $pageTitle = 'User List';
        $users = $this->userModel->getUsers();
        $this->viewData['pageMetaTitle'] = $pageTitle;
        $this->viewData['pageTitle']=$pageTitle;
        $this->viewData['users']= $users;
        return view('backend/users/index', $this->viewData);
    }

    public function create()
    {
        $pageTitle = 'Create User';
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
        return view('backend/users/create', $this->viewData);
    }

    public function store()
    {
        $pageTitle = 'Create User';
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
            'status'    => $this->request->getVar('status'),
            'created_at'    => Time::createFromTimestamp(time()),
            'updated_at'    => Time::createFromTimestamp(time())
        ];

        $this->viewData['pageMetaTitle'] = $pageTitle;
        $this->viewData['pageTitle']=$pageTitle;
        $this->viewData['userData']= $userData;
        if($this->validate($rules)) {
            $this->userModel->insert($userData);
            if($this->userModel->affectedRows() != false) {
                 $this->session->setFlashdata('msg', 'User created successfully.');
                return redirect()->to(route_to("user.list"));
            } else {
                $this->session->setFlashdata('err_msg', 'User create error.');
                return view('backend/users/create', $this->viewData);
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
            return view('backend/users/create', $this->viewData);
        }
    }

    public function show($id = null)
    {
        $pageTitle = 'User';
        $userData = $this->userModel->getUserById($id);
        $this->viewData['pageMetaTitle'] = $pageTitle;
        $this->viewData['pageTitle']=$pageTitle;
        $this->viewData['userData']= $userData;
        $this->viewData['isProfile']= false;    
        return view('backend/users/show', $this->viewData);
    }

    public function delete($id = null)
    {
        $userData = $this->userModel->deleteUserById($id);
        $this->session->setFlashdata('msg', 'User deleted successfully.');
        return redirect()->to(route_to("user.list"));
    }

    public function edit($id = null)
    {
        $pageTitle = 'Edit User';
        $userData = $this->userModel->getUserById($id);
        $this->viewData['pageMetaTitle'] = $pageTitle;
        $this->viewData['pageTitle']=$pageTitle;
        $this->viewData['userData']= $userData;
        return view('backend/users/edit', $this->viewData);
    }

    public function saveEdit()
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
            'zip'          => 'required',
            'status'          => 'required'
        ];

        if(trim($this->request->getVar('password')) != ''){
            $rules['password'] = 'required|min_length[5]|max_length[50]|matches[confirm_password]';
            $rules['confirm_password'] = 'required|min_length[5]|max_length[50]';
        }

        if($this->validate($rules)){
            $userId = $this->request->getVar('id');
            
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
            if(trim($this->request->getVar('password')) != ''){
                $userData['passwprd'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
            }

            if($this->userModel->update($userId, $userData) === true) {
                 $this->session->setFlashdata('msg', 'User updated successfully.');
                return redirect()->to(route_to("user.list"));
            } else {
                $this->session->setFlashdata('err_msg', 'User update error.');
                $pageTitle = 'User Profile';
                return view('backend/users/edit', $this->viewData);
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
            return redirect()->to(route_to("user.edit"));
        }
    }

   

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(route_to("user.login"));
    }

    function is_logged_in() {       
        return $this->session->has('username');
    }
}