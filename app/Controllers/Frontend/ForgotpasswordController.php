<?php

namespace App\Controllers\Frontend;
use App\Controllers\BaseController;
use App\Models\User;
use App\Models\UsersPasswordReset;
use CodeIgniter\I18n\Time;

class ForgotpasswordController extends BaseController
{
    private $userModel;
    private $userPasswordResetModel;
    private $session;
    private $viewData;

    public function __construct() {
        $this->userModel = new User();
        $this->session = session();
        $this->userPasswordResetModel = new UsersPasswordReset();
        $this->viewData = [
            'pageMetaTitle'=>'Forgot Password',
            'pageTitle'=> 'Forgot Password'
        ];
    }

    public function forgotpassword()
    {
        helper(['form']);
        echo view('frontend/forgotpassword', $this->viewData);
    } 
  
    public function sendForgotLink()
    {
        $email = $this->request->getVar('email');
        $userData = $this->userModel->getUserByEmail($email);  
        if($userData) {
            $this->sendPasswordResetLink($userData);        
        } else {
            $this->session->setFlashdata('msg','Email does not exist.');
            return redirect()->to(route_to("frontend.forgotpassword"));
        }
    }

    private function sendPasswordResetLink($userData)
    {
        $userEmail = $userData['email'];

        if (!empty($userEmail))      
        {
            $passwordplain = "";
            $passwordplain  = rand(999999999,9999999999);
            $token = md5($passwordplain);
            $passwordResetLink = base_url().route_to('frontend.resetpassword.form',$token);
            $userId = $userData['id'];

            $userPasswordResetData = [
                'email'    => $userEmail,
                'token'    => $token,
                'user_id'    => $userData['id'],
                'created_at'    => Time::createFromTimestamp(time()),
                'updated_at'    => Time::createFromTimestamp(time())
            ];

            $userPasswordReset = $this->userPasswordResetModel->getUserByEmail($userEmail,$userId);
             $res = false;
            if($userPasswordReset) {
                unset($userPasswordResetData['user_id']);
                if($this->userPasswordResetModel->updateUserByAdmnid($userId,$userPasswordResetData) == true) {
                    $res = true;
                }
            } else {
                $this->userPasswordResetModel->insert($userPasswordResetData);
                $res = $this->userPasswordResetModel->affectedRows();
            }

            if($res != false) {

                $to_name = $userData['first_name'];
                $to_email = $userData['email'];
                $mail_message='Dear '.$userData['first_name'].','. "\r\n";
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
            redirect()->to(route_to("frontend.forgotpassword"));
        }
        else
        {  
            $this->session->setFlashdata('err_msg','Email not found try again!');
            redirect()->to(route_to("frontend.forgotpassword"));
        }
    }

    public function resetpasswordform($token = null)
    {
        if(!empty($token)) {
            helper(['form']);
            $userPasswordReset = $this->userPasswordResetModel->getUserByToken($token);
            
            if(!empty($userPasswordReset)) {
                $this->viewData['pageMetaTitle'] = 'Reset Password';
                $this->viewData['pageTitle'] = 'Reset Password';
                $this->viewData['userPasswordReset'] = $userPasswordReset;
                echo view('frontend/resetpassword', $this->viewData);
            } else {
                $this->session->setFlashdata('err_msg','Your token has expired');
                return redirect()->to(route_to("frontend.forgotpassword"));
            }
        } else {
            $this->session->setFlashdata('err_msg','Email not found try again!');
            return redirect()->to(route_to("frontend.forgotpassword"));
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

        $userPasswordReset = [
            'token'    => $token
        ];

        if($this->validate($rules)) {
            $userPasswordReset = $this->userPasswordResetModel->getUserByToken($token);
            if(!empty($userPasswordReset)) {
                $userData = [
                    'password'     => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'updated_at'    => Time::createFromTimestamp(time())
                ];
                $userId = $userPasswordReset['user_id'];
                if($this->userModel->update($userId, $userData) === true) {
                    $userPasswordResetData = [
                        'token'    => ''
                    ];
                    $this->userPasswordResetModel->updateUserByUserid($userId,$userPasswordResetData);
                    
                    $this->session->setFlashdata('msg', 'Password changed successfully.');
                    return redirect()->to(route_to("frontend.login"));
                } else {
                    $this->session->setFlashdata('err_msg', 'Password changed error.');
                    return view('backend/resetpassword',['userPasswordReset'=>$userPasswordReset]);
                }
            } else {
                $this->session->setFlashdata('err_msg','Your token is invalid or has expired');
                return redirect()->to(route_to("frontend.forgotpassword"));
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
            return view('frontend/resetpassword',['userPasswordReset'=>$userPasswordReset]);
        }
    }
}