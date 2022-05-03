<?php

namespace App\Controllers\Backend;
use App\Controllers\BaseController;
use App\Models\Admin;
use App\Models\AdminsPasswordReset;
use CodeIgniter\I18n\Time;

class ForgotpasswordController extends BaseController
{
    private $adminModel;
    private $adminPasswordResetModel;
    private $session;
    private $viewData;

    public function __construct() {
        $this->adminModel = new Admin();
        $this->adminPasswordResetModel = new AdminsPasswordReset();
        $this->session = session();
        $this->viewData = [
            'pageMetaTitle'=>'Forgot Password',
            'pageTitle'=> 'Forgot Password'
        ];
    }

    public function forgotpassword()
    {
        helper(['form']);
        echo view('backend/forgotpassword', $this->viewData);
    } 
  
    public function sendForgotLink()
    {
        $email = $this->request->getVar('email');
        $adminData = $this->adminModel->getAdminByEmail($email);  
        if($adminData) {
            $this->sendPasswordResetLink($adminData);        
        } else {
            $this->session->setFlashdata('msg','Email does not exist.');
            return redirect()->to(route_to("admin.forgotpassword"));
        }
    }

    private function sendPasswordResetLink($adminData)
    {
        $adminEmail = $adminData['email'];

        if (!empty($adminEmail))      
        {
            $passwordplain = "";
            $passwordplain  = rand(999999999,9999999999);
            $token = md5($passwordplain);
            $passwordResetLink = base_url().route_to('admin.resetpassword.form',$token);
            $adminId = $adminData['id'];

            $adminPasswordResetData = [
                'email'    => $adminEmail,
                'token'    => $token,
                'admin_id'    => $adminData['id'],
                'created_at'    => Time::createFromTimestamp(time()),
                'updated_at'    => Time::createFromTimestamp(time())
            ];

            $adminPasswordReset = $this->adminPasswordResetModel->getAdminByEmail($adminEmail,$adminId);
             $res = false;
            if($adminPasswordReset) {
                unset($adminPasswordResetData['admin_id']);
                if($this->adminPasswordResetModel->updateAdminByAdmnid($adminId,$adminPasswordResetData) == true) {
                    $res = true;
                }
            } else {
                $this->adminPasswordResetModel->insert($adminPasswordResetData);
                $res = $this->adminPasswordResetModel->affectedRows();
            }

            if($res != false) {

                $to_name = $adminData['first_name'];
                $to_email = $adminData['email'];
                $mail_message='Dear '.$adminData['first_name'].','. "\r\n";
                $mail_message.='Thanks for contacting us regarding to forgot password,<br> Please click on <a href="'.$passwordResetLink.'">link</a> to reset your password.</b>'."\r\n";
                $mail_message.='<br>If you face any issue in direct link, copy and use below link in your browser <br>';
                 $mail_message.= $passwordResetLink;

                $mail_message.='<br>Thanks & Regards';
                $mail_message.='<br>CI Master';

                $mail = \Config\Services::email();
                $mail->setFrom('donotreply@example.com', 'CI Master');
                $mail->setTo($to_email);
                $mail->setSubject('CI Master - Forgot password reset link');
                $mail->setMessage($mail_message);//your message here
             
                //$mail->setCC('another@example.com');//CC
                //$mail->setBCC('thirdEmail@emialHere');// and BCC
                //$filename = '/img/yourPhoto.jpg'; //you can use the App patch 
                //$mail->attach($filename);

                if (!$mail->send()) {
                    $this->session->setFlashdata('err_msg','Failed to send password reset link, please try again!');
                } else {
                   $this->session->setFlashdata('msg','Password reset link sent to your email!');
                }
            } else {
                $this->session->setFlashdata('err_msg','Failed to send password reset link, please try again!');
            }
            redirect()->to(route_to("admin.forgotpassword"));
        }
        else
        {  
            $this->session->setFlashdata('err_msg','Email not found try again!');
            redirect()->to(route_to("admin.forgotpassword"));
        }
    }

    public function resetpasswordform($token = null)
    {
        if(!empty($token)) {
            helper(['form']);
            $adminPasswordReset = $this->adminPasswordResetModel->getAdminByToken($token);
            
            if(!empty($adminPasswordReset)) {
                $this->viewData['pageMetaTitle'] = 'Reset Password';
                $this->viewData['pageTitle'] = 'Reset Password';
                $this->viewData['adminPasswordReset'] = $adminPasswordReset;
                echo view('backend/resetpassword', $this->viewData);
            } else {
                $this->session->setFlashdata('err_msg','Your token has expired');
                return redirect()->to(route_to("admin.forgotpassword"));
            }
        } else {
            $this->session->setFlashdata('err_msg','Email not found try again!');
            return redirect()->to(route_to("admin.forgotpassword"));
        }
    }

    public function resetpassword()
    {
        $token = $this->request->getVar('token');
        $rules = [
            'token'          => 'required',
            'password'         => 'required|min_length[5]|max_length[50]|matches[confirm_password]',
            'confirm_password'         => 'required|min_length[5]|max_length[50]'
        ];

        $adminPasswordReset = [
            'token'    => $token
        ];

        if($this->validate($rules)) {
            $adminPasswordReset = $this->adminPasswordResetModel->getAdminByToken($token);
            if(!empty($adminPasswordReset)) {
                $adminData = [
                    'password'     => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'updated_at'    => Time::createFromTimestamp(time())
                ];
                $adminId = $adminPasswordReset['admin_id'];
                if($this->adminModel->update($adminId, $adminData) === true) {
                    $adminPasswordResetData = [
                        'token'    => ''
                    ];
                    $this->adminPasswordResetModel->updateAdminByAdmnid($adminId,$adminPasswordResetData);
                    
                    $this->session->setFlashdata('msg', 'Password changed successfully.');
                    return redirect()->to(route_to("admin.login"));
                } else {
                    $this->session->setFlashdata('err_msg', 'Password changed error.');
                    return view('backend/resetpassword',['adminPasswordReset'=>$adminPasswordReset]);
                }
            } else {
                $this->session->setFlashdata('err_msg','Your token is invalid or has expired');
                return redirect()->to(route_to("admin.forgotpassword"));
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
            return view('backend/resetpassword',['adminPasswordReset'=>$adminPasswordReset]);
        }
    }
}