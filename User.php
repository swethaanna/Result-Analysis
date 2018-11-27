<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('url'));
        $this->load->model('User_model');

    }

    public function index()
    {
        $this->load->library('form_validation');
        $this->load->view('login');
    }

    public function register()
    {

        // create the data object
        $data = new stdClass();

        // load form helper and validation library
        $this->load->helper('form');
        $this->load->library('form_validation');

        // set validation rules
        $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[tbl_user.user_name]', array('is_unique' => 'This username already exists. Please choose another one.'));
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tbl_user.email]', array('is_unique' => 'This email already registered. Please choose another one.'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|matches[password]');

        if ($this->form_validation->run() === false) {

            // validation not ok, send validation errors to the view
            $data->instdata = array_values($this->getInstitutions());
            $this->load->view('register', $data);

        } else {

            // set variables from the form
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $institution_id = $this->input->post('institution_id');
            $department_id = $this->input->post('department_id');

            if ($this->User_model->create_user($username, $email, $password, $institution_id, $department_id)) {

                $this->load->view('login');


            } else {

                // user creation failed, this should never happen
                $data->error = 'There was a problem creating your new account. Please try again.';

                // send error to the view
                $this->load->view('login');

            }

        }

    }


    public function login()
    {

        // create the data object
        $data = new stdClass();

        // load form helper and validation library
        $this->load->helper('form');
        $this->load->library('form_validation');

        // set validation rules
        $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {

            // validation not ok, send validation errors to the view
            $this->load->view('login');

        } else {

            // set variables from the form
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $remember_me = $this->input->post('remember_me');
            if ($this->User_model->resolve_user_login($username, $password)) {

                $user_id = $this->User_model->get_user_id_from_username($username);
                $user = $this->User_model->get_user($user_id);
                $role_id = (bool)$user->role_id;
                // set session user datas
                $new_data = array(
                    'user_id' => $user->user_id,
                    'user_name' => $user->user_name,
                    'logged_in' => TRUE,
                    'is_confirmed' => $remember_me,
                    'is_admin' => $role_id,
                    'department_id' => $user->department_id,
                    'institution_id' => $user->institution_id
                );
                $this->session->set_userdata('userdata', $new_data);
                if ($role_id) {
                    // user login ok
                    redirect('admin/index', $data);
                } else {
                    redirect('activeUser/index');
                }
            } else {
                // login failed
                $data->error = 'Wrong username or password.';
                $this->load->view('login', $data);
            }

        }

    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('user/login');
    }

    public function getInstitutions()
    {
        return $this->User_model->get_institutionsByDistrict();
    }

    public function fetchCourses()
    {
        $output = "";
        if ($this->input->post('institution_id')) {
            $departmentData = $this->User_model->fetchCourses($this->input->post('institution_id'));
            foreach ($departmentData as $value) {
                foreach ($value as $key => $val) {
                    $output .= '<optgroup label="' . $key . '">';
                    foreach ($val as $option) {
                        $output .= '<option value="' . $option['id'] . '">' . $option['name'] . '</option>';
                    }
                    $output .= '</optgroup>';
                }
            }
            echo $output;

        }
    }
}