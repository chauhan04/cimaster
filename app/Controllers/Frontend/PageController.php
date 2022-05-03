<?php

namespace App\Controllers\Frontend;
use App\Controllers\BaseController;

class PageController extends BaseController
{
    private $viewData;
    private $session;

    public function __construct() {
        $this->session = session();
        $this->viewData = [
            'pageMetaTitle'=>'Contact Us',
            'pageTitle'=> 'Contact Us'
        ];
    }

    public function aboutus()
    {
        $this->viewData = [
            'pageMetaTitle'=>'About Us',
            'pageTitle'=> 'About Us'
        ];
        echo view('frontend/pages/aboutus', $this->viewData);
    } 
  
    public function contactus()
    {
        $this->viewData = [
            'pageMetaTitle'=>'Contact Us',
            'pageTitle'=> 'Contact Us'
        ];
        echo view('frontend/pages/contactus', $this->viewData);
    }

    public function contactemail()
    {
        $this->viewData = [
            'pageMetaTitle'=>'Contact Us',
            'pageTitle'=> 'Contact Us'
        ];

        $rules = [
            'name'          => 'required',
            'email'         => 'required|min_length[6]|max_length[50]|valid_email',
            'subject'          => 'required',
            'message'          => 'required'
        ];

        $fromName = $this->request->getVar('name');
        $fromEmail = $this->request->getVar('email');
        $subject = $this->request->getVar('subject');
        $message = $this->request->getVar('message');
        if($this->validate($rules)) {
            $toEmail = 'developer8here@gmail.com';
            $mail_message = 'Name :'.$fromName.','. "\r\n";
            $mail_message .= 'Email :'.$fromEmail.','. "\r\n";
            $mail_message .= 'Message :'.$message. "\r\n";

            $mail = \Config\Services::email();
            $mail->setFrom($fromEmail, $fromName);
            $mail->setTo($toEmail);
            $mail->setSubject($subject.'(CI Master)');
            $mail->setMessage($mail_message);//your message here

            if (!$mail->send()) {
                $this->session->setFlashdata('err_msg','Failed to send email, please try again!');
            } else {
               $this->session->setFlashdata('msg','Contact info sent successfully.');
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
            return view('frontend/pages/contactus', $this->viewData);
        }
        return redirect()->to(route_to("contactus"));
    }

    public function subscribe()
    {
        //save the subscribe data


        return redirect()->to($_SERVER['HTTP_REFERER']);
    }
}