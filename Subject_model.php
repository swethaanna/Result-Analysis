<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Subject_model extends CI_Model
{

    const ID = 'tbl_subject';

    /**
     * Auth_model constructor.
     */
    const TBL_SUBJECTS = 'tbl_subject';

    public function __construct()
    {

        parent::__construct();
        $this->load->database();

    }

    public function create($data)
    {
        return $this->db->insert(self::TBL_SUBJECTS, $data);
    }

    public function update($data, $id)
    {
        $this->db->where(self::ID, $id);
        return $this->db->update(self::TBL_SUBJECTS, $data);
    }

    public function delete($id)
    {
        $this->db->where(self::ID, $id);
        return $this->db->delete(self::TBL_SUBJECTS);
    }


    public function get_data_from_property($property, $value)
    {
        $this->db->from(self::TBL_SUBJECTS);
        $this->db->where($property, $value);
        return $this->db->get()->result_array();
    }

    public function get_subjects()
    {
        $this->db->from(self::TBL_SUBJECTS);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function fetchDepartments($course_id)
    {
        $sortedArray = array();
        $this->db->select('department_code,department_name,department_course');
        $this->db->from('tbl_department');
        $this->db->where('department_course', $course_id);
        $resultSelectIndexes = $this->db->get();
        $resultSelectIndexes = $resultSelectIndexes->result_array();
        foreach ($resultSelectIndexes as $resultSelectIndex) {
            $department_name = $resultSelectIndex['department_name'];
            $department_code = $resultSelectIndex['department_code'];
            $temp = array("id" => $department_code, "name" => $department_name);
            array_push($sortedArray, $temp);
        }

        return $sortedArray;
    }

}