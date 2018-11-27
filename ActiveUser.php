<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ActiveUser extends MY_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model('User_model');

    }

    public function index()
    {
        $this->load->library('form_validation');
        $this->load->view('user/dashboard_user');
    }

}