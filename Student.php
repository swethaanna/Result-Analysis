<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends MY_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('url'));
        $this->load->model('Student_model');

    }

    public function index()
    {
//        $data = new stdClass();
//        $this->load->library('form_validation');
//        $user_data = $this->session->userdata('userdata');
//        $department_id = $user_data['department_id'];
//        if (!empty($department_id)) {
//            //print_r($this->getSemester($department_id));
//            $data->instdata = array_values($this->getSemester($department_id));
//            $this->load->view('user/dashboard_user', $data);
//        }
        $this->load->view('user/dashboard_user');
    }

    public function getdata()
    {
        $user_data = $this->session->userdata('userdata');
        $department_id = $user_data['department_id'];
        $data = $this->Student_model->get_students($department_id);
        echo json_encode(array("data" => $data));
    }

    public function delete()
    {
        $id = $this->input->post('id');
        return $this->Student_model->delete($id);
    }

    public function create()
    {
        $data = new stdClass();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $submitType = $this->input->post('create_update');
        $id = $this->input->post('student_id');
        $user_data = $this->session->userdata('userdata');
        $department_id = $user_data['department_id'];
        if (!empty($department_id)) {
            //print_r($this->getSemester($department_id));
            $data->instdata = array_values($this->getSemester($department_id));
        }


        // set validation rules
        $this->form_validation->set_rules('student_regno', 'Register Number', 'trim|required|is_unique[tbl_student.student_regno]', array('is_unique' => 'This Register Number is already Available. Please Update from the records'));

        if ($this->form_validation->run() === false) {

            // validation not ok, send validation errors to the view
            $this->load->view('user/persist_students', $data);

        } else {
            if ($submitType == "Create") {
                $data = $this->postData();
                if ($this->Student_model->create($data)) {
                    $this->load->view('user/persist_students');
                }
            } else {
                $data = $this->postData();
                if ($this->Student_model->update($data, $id)) {
                    $this->load->view('user/persist_students');
                }
            }
        }
    }

    private function postData()
    {
        $user_data = $this->session->userdata('userdata');
        $department_id = $user_data['department_id'];
        $institution_id = $user_data['institution_id'];
        $student_name = $this->input->post('student_name');
        $student_regno = $this->input->post('student_regno');
        $student_semester = $this->input->post('current_semster');
        $joining_year = $this->input->post('student_batch');
        $course_id = $this->Student_model->getCourse($department_id);
        $data = array(
            'student_name' => $student_name,
            'student_regno' => $student_regno,
            'current_semster' => $student_semester,
            'student_batch' => $joining_year,
            'student_institution' => $institution_id,
            'student_department' => $department_id,
            'student_course' => $course_id,
            'student_status' => "active"
        );
        return $data;
    }

    public function getSemester($department_id)
    {
        return $this->Student_model->getNumberOfSemesters($department_id);
    }

}