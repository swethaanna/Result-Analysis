<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Institution_model extends CI_Model
{

    const INSTITUTION_CODE = 'institution_code';
    const TBL_INSTITUTION = 'tbl_institution';
    const INSTITUTION_DISTRICT = 'institution_district';
    const INSTITUTION_ID = 'institution_id';

    /**
     * Institution_model constructor.
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->database();

    }

    /**
     * @param $data
     * @return mixed
     */
    public function create_institution($data, $courses)
    {
        $institution_code = $data['institution_code'];
        $insertData = array();
        foreach ($courses as $course) {
            $insertData[] = array("institution_code" => $institution_code, "course_code" => $course);
        }
        $this->db->insert_batch('tbl_instdata', $insertData);
        return $this->db->insert(self::TBL_INSTITUTION, $data);
    }

    public function update_institution($data, $institution_id, $courses)
    {
        $institution_code = $data['institution_code'];
        $insertData = array();
        foreach ($courses as $course) {
            $insertData[] = array("institution_code" => $institution_code, "course_code" => $course);
        }
        $this->db->insert_batch('tbl_instdata', $insertData);
        $this->db->where(self::INSTITUTION_ID, $institution_id);
        return $this->db->update(self::TBL_INSTITUTION, $data);
    }

    public function delete_institution($institution_id)
    {
        $this->db->where(self::INSTITUTION_ID, $institution_id);
        return $this->db->delete(self::TBL_INSTITUTION);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function get_institution_from_id($id)
    {
        $this->db->from(self::TBL_INSTITUTION);
        $this->db->where(self::INSTITUTION_ID, $id);
        return $this->db->get()->row();
    }

    /**
     * @param $institution_code
     * @return bool
     */
    public function get_institution_from_institution_code($institution_code)
    {
        $this->db->from(self::TBL_INSTITUTION);
        $this->db->where(self::INSTITUTION_CODE, $institution_code);
        $this->db->get()->row();
        return true;
    }

    /**
     * @return mixed
     */
    public function get_institutions()
    {
        $this->db->from(self::TBL_INSTITUTION);
        $result = $this->db->get();
        return $result->result_array();

    }

    /**
     * @return array
     */
    public function get_institutionsByDistrict()
    {
        $resultData = array();
        $this->db->select(self::INSTITUTION_DISTRICT);
        $this->db->from(self::TBL_INSTITUTION);
        $this->db->group_by(self::INSTITUTION_DISTRICT);
        $resultDistricts = $this->db->get();
        $resultDistricts = $resultDistricts->result_array();

        $this->db->select('institution_id,institution_name,institution_district');
        $this->db->from(self::TBL_INSTITUTION);
        $this->db->order_by(self::INSTITUTION_DISTRICT);
        $resultInstitutions = $this->db->get();
        $resultInstitutions = $resultInstitutions->result_array();
        foreach ($resultDistricts as $resultDistrict) {
            $district = $resultDistrict[self::INSTITUTION_DISTRICT];
            $sortedArray = array();
            foreach ($resultInstitutions as $resultInstitution) {
                if ($resultInstitution[self::INSTITUTION_DISTRICT] == $district) {
                    $institution_name = $resultInstitution['institution_name'];
                    $institution_id = $resultInstitution[self::INSTITUTION_ID];
                    $temp = array("id" => $institution_id, "name" => $institution_name);
                    array_push($sortedArray, $temp);
                }
            }
            array_push($resultData, array($district => $sortedArray));
        }
        return $resultData;
    }

    public function get_departments()
    {
        $resultData = array();
        $this->db->select('course_id,course_code');
        $this->db->from('tbl_department');
        $this->db->join('tbl_courses', 'tbl_department.department_course = tbl_courses.course_id');
        $this->db->group_by('department_course');
        $resultGroupIndexes = $this->db->get();
        $resultGroupIndexes = $resultGroupIndexes->result_array();

        $this->db->select('department_code,department_name,department_course');
        $this->db->from('tbl_department');
        $this->db->order_by('department_course');
        $resultSelectIndexes = $this->db->get();
        $resultSelectIndexes = $resultSelectIndexes->result_array();

        foreach ($resultGroupIndexes as $resultGroupIndex) {
            $groupIndex = $resultGroupIndex['course_code'];
            $sortedArray = array();
            foreach ($resultSelectIndexes as $resultSelectIndex) {
                if ($resultSelectIndex['department_course'] == $resultGroupIndex['course_id']) {
                    $department_name = $resultSelectIndex['department_name'];
                    $department_code = $resultSelectIndex['department_code'];
                    $temp = array("id" => $department_code, "name" => $department_name);
                    array_push($sortedArray, $temp);
                }
            }
            array_push($resultData, array($groupIndex => $sortedArray));
        }
        return $resultData;

    }

}