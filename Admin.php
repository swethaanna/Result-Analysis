<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {
    public function __construct()
    {

        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model('User_model');

    }

    public function index(){
        $this->load->view('admin/dashboard_admin');
    }

    public function institutions(){
        $this->load->view('admin/persist_institutions');
    }
    public function departments(){
        $this->load->view('admin/dashboard_admin');
    }
    public function courses(){
        $this->load->view('admin/dashboard_admin');
    }
    public function subjects(){
        $this->load->view('admin/dashboard_admin');
    }
    public function users(){
        $this->load->view('admin/dashboard_admin');
    }
    public function exams(){
        $this->load->view('admin/dashboard_admin');
    }

}