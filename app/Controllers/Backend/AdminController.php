<?php

namespace App\Controllers\Backend;
use App\Controllers\BaseController;
use App\Models\Admin;
use CodeIgniter\I18n\Time;

class AdminController extends BaseController
{
    private $adminModel;
    private $session;
    private $viewData;

    public function __construct() {
        $this->adminModel = new Admin();
        $this->session = session();
        $this->viewData = [
            'pageMetaTitle'=>'Dashboard',
            'pageTitle'=> 'Dashboard'
        ];
    }

    public function dashboard()
    {
        $this->viewData['pageMetaTitle'] = 'Admin Dashboard';
        $this->viewData['pageTitle'] = 'Admin Dashboard';
        return view('backend/admins/dashboard', $this->viewData);
    }

    public function index()
    {
        $pageTitle = 'Admin List';
        $admins = $this->adminModel->getAdmins();
        $this->viewData['pageMetaTitle'] = $pageTitle;
        $this->viewData['pageTitle']=$pageTitle;
        $this->viewData['admins']= $admins;
        return view('backend/admins/index', $this->viewData);
    }

    public function create()
    {
        $pageTitle = 'Create Admin';
        $adminData = [
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
        $this->viewData['adminData']= $adminData;
        return view('backend/admins/create', $this->viewData);
    }

    public function store()
    {
        $pageTitle = 'Create Admin';
        $rules = [
            'first_name'          => 'required',
            'last_name'          => 'required',
            'username'      => 'required|min_length[6]|max_length[100]',
            'email'         => 'required|min_length[6]|max_length[50]|valid_email|is_unique[admins.email]',
            'password'         => 'required|min_length[5]|max_length[50]|matches[confirm_password]',
            'confirm_password'         => 'required|min_length[5]|max_length[50]',
            'phone'          => 'required',
            'address_line_1'          => 'required',
            'country_code'          => 'required',
            'state'          => 'required',
            'city'          => 'required',
            'zip'          => 'required'
        ];

        $adminData = [
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
        $this->viewData['adminData']= $adminData;

        if($this->validate($rules)) {
            $this->adminModel->insert($adminData);
            if($this->adminModel->affectedRows() != false) {
                 $this->session->setFlashdata('msg', 'Admin created successfully.');
                return redirect()->to(route_to("admin.list"));
            } else {
                $this->session->setFlashdata('err_msg', 'Admin create error.');
                //['pageTitle'=>$pageTitle, 'adminData'=>$adminData]
                return view('backend/admins/create', $this->viewData);
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
            return view('backend/admins/create', $this->viewData);
        }
    }

    public function show($id = null)
    {
        $pageTitle = 'Admin';
        $adminData = $this->adminModel->getAdminById($id);
        $this->viewData['pageMetaTitle'] = $pageTitle;
        $this->viewData['pageTitle']=$pageTitle;
        $this->viewData['adminData']= $adminData;
        $this->viewData['isProfile']= false;
        return view('backend/admins/show', $this->viewData);
    }

    public function delete($id = null)
    {
        $adminData = $this->adminModel->deleteAdminById($id);
        $this->session->setFlashdata('msg', 'Admin deleted successfully.');
        return redirect()->to(route_to("admin.list"));
    }

    public function edit($id = null)
    {
        $pageTitle = 'Edit Admin';
        $adminData = $this->adminModel->getAdminById($id);
        $this->viewData['pageMetaTitle'] = $pageTitle;
        $this->viewData['pageTitle']=$pageTitle;
        $this->viewData['adminData']= $adminData;
        return view('backend/admins/edit', $this->viewData);
    }

    public function saveEdit()
    {
        $pageTitle = 'Admins';
        $rules = [
            'first_name'          => 'required',
            'last_name'          => 'required',
            'username'      => 'required|min_length[6]|max_length[100]',
            'email'         => 'required|min_length[6]|max_length[50]|valid_email|is_unique[admins.email,id,{id}]',
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

        $adminId = $this->request->getVar('id');
        if($this->validate($rules)){
            $sessionAdminId = session()->get('email');
            $adminId = $this->request->getVar('id');
            
            $adminData = [
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
            $this->viewData['adminData']= $adminData;

            if(trim($this->request->getVar('password')) != ''){
                $adminData['passwprd'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
            }

            if($this->adminModel->update($adminId, $adminData) === true) {
                 $this->session->setFlashdata('msg', 'Admin updated successfully.');
                return redirect()->to(route_to("admin.list"));
            } else {
                $this->session->setFlashdata('err_msg', 'Admin update error.');
                $pageTitle = 'Admin Profile';
                return view('backend/admins/edit', $this->viewData);
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
            return redirect()->to(route_to("admin.edit",$adminId));
        }
    }

    public function profile()
    {
        $pageTitle = 'Admin Profile';
        $adminData = $this->adminModel->getAdminByEmail(session()->get('email'));
        $this->viewData['pageMetaTitle'] = $pageTitle;
        $this->viewData['pageTitle']=$pageTitle;
        $this->viewData['adminData']= $adminData;
        $this->viewData['isProfile']= false;
        return view('backend/admins/profile', $this->viewData);
    }

    public function editProfile()
    {
        $pageTitle = 'Admin Profile';
        $adminData = $this->adminModel->getAdminByEmail(session()->get('email'));
        $this->viewData['pageMetaTitle'] = $pageTitle;
        $this->viewData['pageTitle']=$pageTitle;
        $this->viewData['adminData']= $adminData;
        return view('backend/admins/edit-profile', $this->viewData);
    }

    public function saveProfile()
    {
        $pageTitle = 'Admin Profile';
        $rules = [
            'first_name'          => 'required',
            'last_name'          => 'required',
            'username'      => 'required|min_length[6]|max_length[100]',
            'email'         => 'required|min_length[6]|max_length[50]|valid_email|is_unique[admins.email,id,{id}]',
            'phone'          => 'required',
            'address_line_1'          => 'required',
            'country_code'          => 'required',
            'state'          => 'required',
            'city'          => 'required',
            'zip'          => 'required'
        ];

        if($this->validate($rules)){
            $sessionAdminId = session()->get('email');
            $adminId = $this->request->getVar('id');
            
            $adminData = [
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
                'updated_at'    => Time::createFromTimestamp(time())
            ];

            $this->viewData['pageMetaTitle'] = $pageTitle;
            $this->viewData['pageTitle']=$pageTitle;
            $this->viewData['adminData']= $adminData;

            if($sessionAdminId == $adminId) {
                if($this->adminModel->update($adminId, $adminData) === true) {
                     $this->session->setFlashdata('msg', 'Profile updated successfully.');
                    return redirect()->to(route_to("admin.profile"));
                } else {
                    $this->session->setFlashdata('err_msg', 'Profile update error.');
                    $pageTitle = 'Admin Profile';
                    return view('backend/admins/edit-profile', $this->viewData);
                }
            } else {
                $this->session->setFlashdata('err_msg', 'You can not update profile of other admin.');
                $pageTitle = 'Admin Profile';
                return view('backend/admins/edit-profile', $this->viewData);
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
            return redirect()->to(route_to("admin.profile.edit"));
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(route_to("admin.login"));
    }

    function is_logged_in() {       
        return $this->session->has('username');
    }
}