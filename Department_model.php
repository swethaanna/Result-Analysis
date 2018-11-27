<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Department_model extends CI_Model
{

    /**
     * Auth_model constructor.
     */
    const COURSE_CODE = 'course_code';

    const TBL_COURSES = 'tbl_courses';

    const COURSE_TYPE = 'course_type';

    const ID = 'department_id';

    const TBL_NAME = 'tbl_department';

    public function __construct()
    {

        parent::__construct();
        $this->load->database();

    }

    public function create($data)
    {
        return $this->db->insert(self::TBL_NAME, $data);
    }

    public function update($data, $id)
    {
        $this->db->where(self::ID, $id);
        return $this->db->update(self::TBL_NAME, $data);
    }

    public function delete($id)
    {
        $this->db->where(self::ID, $id);
        return $this->db->delete(self::TBL_NAME);
    }


    public function get_department_from_id($id)
    {
        $this->db->from(self::TBL_NAME);
        $this->db->where(self::ID, $id);
        return $this->db->get()->row();

    }

    public function get_departments_from_property($property, $value)
    {
        $this->db->from(self::TBL_NAME);
        $this->db->where($property, $value);
        return $this->db->get()->result_array();

    }

    public function getIdByCourseName($name)
    {
        $this->db->select('course_id');
        $this->db->from(self::TBL_COURSES);
        $this->db->where('course_code', $name);
        return $this->db->get()->row();

    }

    public function get_departments()
    {
        $this->db->from(self::TBL_NAME);
        $this->db->join('tbl_courses','tbl_department.department_course = tbl_courses.course_id');
        $result = $this->db->get();
        return $result->result_array();

    }

    public function get_courses_by_course_type()
    {
        $resultData = array();
        $this->db->select(self::COURSE_TYPE);
        $this->db->from(self::TBL_COURSES);
        $this->db->group_by(self::COURSE_TYPE);
        $resultCourseTypes = $this->db->get();
        $resultCourseTypes = $resultCourseTypes->result_array();

        $this->db->select('course_id,course_code,course_type');
        $this->db->from(self::TBL_COURSES);
        $this->db->order_by(self::COURSE_TYPE);
        $resultCourses = $this->db->get();
        $resultCourses = $resultCourses->result_array();
        foreach ($resultCourseTypes as $resultCourseType) {
            $courseType = $resultCourseType[self::COURSE_TYPE];
            $sortedArray = array();
            foreach ($resultCourses as $resultCourse) {
                if ($resultCourse[self::COURSE_TYPE] == $courseType) {
                    $course_name = $resultCourse[self::COURSE_CODE];
                    $course_id = $resultCourse['course_id'];
                    $temp = array("id" => $course_id, "name" => $course_name);
                    array_push($sortedArray, $temp);
                }
            }
            array_push($resultData, array($courseType => $sortedArray));
        }
        return $resultData;
    }
}