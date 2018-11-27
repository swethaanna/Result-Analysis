<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Exams_model extends CI_Model
{

    const ID = 'exam_id';

    /**
     * Auth_model constructor.
     */
    const TBL_EXAMS = 'tbl_exams';

    public function __construct()
    {

        parent::__construct();
        $this->load->database();

    }

    public function create($data)
    {
        return $this->db->insert(self::TBL_EXAMS, $data);
    }

    public function update($data,$id)
    {
        $this->db->where(self::ID, $id);
        return $this->db->update(self::TBL_EXAMS, $data);
    }

    public function delete($id)
    {
        $this->db->where(self::ID, $id);
        return $this->db->delete(self::TBL_EXAMS);
    }


    public function get_course_from_id($id)
    {
        $this->db->from(self::TBL_EXAMS);
        $this->db->where('course_id', $id);
        return $this->db->get()->row();

    }

    public function get_course_from_property($property,$value)
    {
        $this->db->from(self::TBL_EXAMS);
        $this->db->where($property, $value);
        return $this->db->get()->result_array();

    }

    public function get_courses()
    {
        $this->db->from(self::TBL_EXAMS);
        $result = $this->db->get();
        return $result->result_array();

    }
}