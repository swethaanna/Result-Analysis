<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends MY_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model('Subject_model');
        $this->load->model('Course_model');
        $this->load->model('Department_model');
        $this->load->model('Student_model');

    }

    public function index()
    {
        $data = new stdClass();
        $this->load->library('form_validation');
        $data->instdata = array_values($this->getCourses());
        $this->load->view('admin/persist_subjects', $data);
    }

    public function getdata()
    {
        $data = $this->Subject_model->get_courses();
        echo json_encode(array("data" => $data));
    }

    public function delete()
    {
        $id = $this->input->post('id');
        return $this->Subject_model->delete($id);
    }

    public function getCourses()
    {
        return $this->Department_model->get_courses_by_course_type();
    }

    public function getDepartmentsByCourseId()
    {
        $output = "<option>Select Department</option>";
        if ($this->input->post('course_id')) {
            $departmentData = $this->Subject_model->fetchDepartments($this->input->post('course_id'));
            foreach ($departmentData as $value) {
                $data = array_values($value);
                $output .= '<option value="' . $data[0] . '">' . $data[1] . '</option>';
            }
            echo $output;
        }
    }

    public function getSemesters()
    {
        $output = "<option>Select Semester</option>";
        if ($this->input->post('department_id')) {
            $departmentData = $this->Student_model->getNumberOfSemesters($this->input->post('department_id'));
            foreach ($departmentData as $value) {
                $data = array_values($value);
                $output .= '<option value="' . $data[0] . '">' . $data[1] . '</option>';
            }
            echo $output;
        }
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
        $data = array(
            'course_name' => $course_name,
            'course_type' => $course_type,
            'course_code' => $course_code,
            'course_semesters' => $course_semesters
        );
        return $data;
    }
}