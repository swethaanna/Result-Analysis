<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends MY_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model('Course_model');

    }

    public function index()
    {
        $this->load->library('form_validation');
        $this->load->view('admin/persist_courses');
    }

    public function getdata()
    {
        $data = $this->Course_model->get_courses();
        echo json_encode(array("data" => $data));
    }

    public function delete()
    {
        $id = $this->input->post('id');
        return $this->Course_model->delete($id);
    }

    public function create()
    {
        $data = new stdClass();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $submitType = $this->input->post('create_update');
        $id = $this->input->post('course_id');

        if ($submitType == "Create") {
            // set validation rules
            $this->form_validation->set_rules('course_code', 'Course Code', 'trim|required|is_unique[tbl_courses.course_code]', array('is_unique' => 'This Course is already registered'));

            if ($this->form_validation->run() === false) {

                // validation not ok, send validation errors to the view
                $this->load->view('admin/persist_courses', $data);

            } else {
                $data = $this->postData();
                if ($this->Course_model->create($data)) {
                    $this->load->view('admin/persist_courses');
                }
            }
        } else {
            $data = $this->postData();
            if ($this->Course_model->update($data, $id)) {
                $this->load->view('admin/persist_courses');
            }
        }
    }

    private function postData()
    {
        $course_name = $this->input->post('course_name');
        $course_type = $this->input->post('course_type');
        $course_code = $this->input->post('course_code');
        $course_semesters = $this->input->post('course_semesters');
        $course_years = $course_semesters / 2;
        $data = array(
            'course_name' => $course_name,
            'course_type' => $course_type,
            'course_code' => $course_code,
            'course_semesters' => $course_semesters,
            'course_years' => $course_years
        );
        return $data;
    }
}