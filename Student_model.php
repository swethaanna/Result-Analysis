<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Student_model extends CI_Model
{

    const ID = 'student_id';

    /**
     * Auth_model constructor.
     */
    const TBL_STUDENTS = 'tbl_student';

    public function __construct()
    {

        parent::__construct();
        $this->load->database();

    }

    public function create($data)
    {
        return $this->db->insert(self::TBL_STUDENTS, $data);
    }

    public function update($data, $id)
    {
        $this->db->where(self::ID, $id);
        return $this->db->update(self::TBL_STUDENTS, $data);
    }

    public function delete($id)
    {
        $this->db->where(self::ID, $id);
        return $this->db->delete(self::TBL_STUDENTS);
    }


    public function get_student_from_id($id)
    {
        $this->db->from(self::TBL_STUDENTS);
        $this->db->where('course_id', $id);
        return $this->db->get()->row();

    }

    public function get_student_from_property($property, $value)
    {
        $this->db->from(self::TBL_STUDENTS);
        $this->db->where($property, $value);
        return $this->db->get()->result_array();

    }

    public function get_students($department_id)
    {
        $this->db->from(self::TBL_STUDENTS);
        $this->db->where('student_department', $department_id);
        $result = $this->db->get();
        return $result->result_array();

    }
    public function getCourse($department_id)
    {
        $this->db->select('department_course');
        $this->db->from('tbl_department');
        $this->db->where('department_code', $department_id);
        $departmentdata = $this->db->get()->row();
        return $departmentdata->department_course;
    }

    public function getNumberOfSemesters($department_id)
    {
        $semsterdata = array();
        $this->db->select('department_course');
        $this->db->from('tbl_department');
        $this->db->where('department_code', $department_id);
        $departmentdata = $this->db->get()->row();

        $this->db->select('course_semesters');
        $this->db->from('tbl_courses');
        $this->db->where('course_id', $departmentdata->department_course);
        $semester = $this->db->get()->row();
        $count = $semester->course_semesters;
        for ($i = 1; $i <= $count; $i++) {
            $semsterdata[] = array("id" => $i, "name" => "Semester " . $i);
        }
        return $semsterdata;
    }
}