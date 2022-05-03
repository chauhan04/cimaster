<?php

namespace App\Controllers\Backend;
use App\Controllers\BaseController;

class PageController extends BaseController
{
    private $viewData;

    public function __construct() {
        $this->viewData = [
            'pageMetaTitle'=>'Contact Us',
            'pageTitle'=> 'Contact Us'
        ];
    }

    public function index()
    {
        echo view('backend/pageview', $this->viewData);
    } 
  
    public function view()
    {
        echo view('backend/pageview', $this->viewData);
    }
}