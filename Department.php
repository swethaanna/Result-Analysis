<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends MY_Controller
{
    const DEFAULT_VIEW = 'admin/persist_departments';

    const DEFAULT_REDIRECT_URL = 'admin/departments';

    public function __construct()
    {

        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model('Department_model');

    }

    public function index()
    {
        $data = new stdClass();
        $this->load->library('form_validation');
        $data->instdata = array_values($this->getCourses());
        $this->load->view(self::DEFAULT_VIEW, $data);
    }

    public function getdata()
    {
        $data = $this->Department_model->get_departments();
        echo json_encode(array("data" => $data));
    }

    public function delete()
    {
        $id = $this->input->post('id');
        return $this->Department_model->delete($id);
    }

    public function getIdByCourseName(){
        $name = $this->input->post('name');
        $response=$this->Department_model->getIdByCourseName($name);
        echo json_encode($response);
    }

    public function create()
    {
        $data = new stdClass();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $submitType = $this->input->post('create_update');
        $id = $this->input->post('department_id');

        if ($submitType == "Create") {
            // set validation rules
            $this->form_validation->set_rules('department_code', 'Department Code', 'trim|required|is_unique[tbl_department.department_code]', array('is_unique' => 'Department exists !!!'));

            if ($this->form_validation->run() === false) {

                // validation not ok, send validation errors to the view
                $this->load->view(self::DEFAULT_VIEW, $data);

            } else {
                $data = $this->postData();
                if ($this->Department_model->create($data)) {
                    redirect(self::DEFAULT_REDIRECT_URL, $data);
                }
            }
        } else {
            $data = $this->postData();
            if ($this->Department_model->update($data, $id)) {
                redirect(self::DEFAULT_REDIRECT_URL, $data);
            }
        }
    }

    private function postData()
    {
        $department_name = $this->input->post('department_name');
        $department_degree = $this->input->post('department_degree');
        $department_information = $this->input->post('department_information');
        $department_code = $this->input->post('department_code');
        $department_course = $this->input->post('course_code');
        $data = array(
            'department_name' => $department_name,
            'department_course' => $department_degree,
            'department_information' => $department_information,
            'department_code' => $department_code,
            'department_course' => $department_course
        );
        return $data;
    }

    public function getCourses()
    {
        return $this->Department_model->get_courses_by_course_type();
    }
}