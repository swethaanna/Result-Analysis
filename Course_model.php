<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Course_model extends CI_Model
{

    const ID = 'course_id';

    /**
     * Auth_model constructor.
     */
    const TBL_COURSES = 'tbl_courses';

    public function __construct()
    {

        parent::__construct();
        $this->load->database();

    }

    public function create($data)
    {
        return $this->db->insert(self::TBL_COURSES, $data);
    }

    public function update($data,$id)
    {
        $this->db->where(self::ID, $id);
        return $this->db->update(self::TBL_COURSES, $data);
    }

    public function delete($id)
    {
        $this->db->where(self::ID, $id);
        return $this->db->delete(self::TBL_COURSES);
    }


    public function get_course_from_id($id)
    {
        $this->db->from(self::TBL_COURSES);
        $this->db->where('course_id', $id);
        return $this->db->get()->row();

    }

    public function get_course_from_property($property,$value)
    {
        $this->db->from(self::TBL_COURSES);
        $this->db->where($property, $value);
        return $this->db->get()->result_array();

    }

    public function get_courses()
    {
        $this->db->from(self::TBL_COURSES);
        $result = $this->db->get();
        return $result->result_array();

    }
}