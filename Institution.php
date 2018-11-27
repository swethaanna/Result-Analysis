<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Institution extends MY_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model('Institution_model');
        $this->load->model('User_model');

    }

    public function index()
    {
        $data = new stdClass();
        $this->load->library('form_validation');
        $data->instdata = array_values($this->getDepartments());
        $this->load->view('admin/persist_institutions', $data);
    }

    public function get_data()
    {
        $data = $this->Institution_model->get_institutions();
        echo json_encode(array("data" => $data));
    }

    public function delete_data()
    {
        $institution_id = $this->input->post('id');
        return $this->Institution_model->delete_institution($institution_id);
    }

    public function create()
    {
        $data = new stdClass();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $submitType = $this->input->post('create_update');
        $institution_id = $this->input->post('institution_id');

        if ($submitType == "Create") {
            // set validation rules
            $this->form_validation->set_rules('institution_code', 'Institution_Code', 'trim|required|is_unique[tbl_institution.institution_code]', array('is_unique' => 'This Institution is already registered'));

            if ($this->form_validation->run() === false) {

                // validation not ok, send validation errors to the view
                $this->load->view('admin/persist_institutions', $data);

            } else {
                $data = $this->postData();
                $courses = $this->input->post('course_code');
                if ($this->Institution_model->create_institution($data, $courses)) {
                    redirect('admin/institutions');
                }
            }
        } else {
            $data = $this->postData();
            if ($this->Institution_model->update_institution($data, $institution_id)) {
                redirect('admin/institutions');
            }
        }
    }

    /**
     * @return array
     */
    private function postData()
    {
        $institution_name = $this->input->post('institution_name');
        $institution_address = $this->input->post('institution_address');
        $institution_district = $this->input->post('institution_district');
        $institution_url = $this->input->post('institution_url');
        $institution_code = $this->input->post('institution_code');
        $data = array(
            'institution_name' => $institution_name,
            'institution_address' => $institution_address,
            'institution_district' => $institution_district,
            'institution_url' => $institution_url,
            'institution_code' => $institution_code
        );
        return $data;
    }

    public function getDepartments()
    {
        return $this->Institution_model->get_departments();
    }

    public function fetchCourses()
    {
        if ($this->input->post('institution_id')) {
            header("Content-Type: application/json");
            echo json_encode($this->User_model->fetchCourses($this->input->post('institution_id')));
        }
    }

}