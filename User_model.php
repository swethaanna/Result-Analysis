<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{

    /**
     * Auth_model constructor.
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->database();

    }


    /**
     * @param $username
     * @param $email
     * @param $password
     * @return mixed
     */
    public function create_user($username, $email, $password, $institution_id, $department_id)
    {
        $data = array(
            'user_name' => $username,
            'email' => $email,
            'password' => $this->hash_password($password),
            'institution_id' => $institution_id,
            'role_id' => 0,
            'remember_me' => 0,
            'created_date' => date('Y-m-j H:i:s'),
            'department_id' => $department_id
        );
        return $this->db->insert('tbl_user', $data);
    }

    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function resolve_user_login($username, $password)
    {

        $this->db->select('password');
        $this->db->from('tbl_user');
        $this->db->where('user_name', $username);
        $hash = $this->db->get()->row('password');
//        if (password_verify($password, $hash)) {
//            print_r("true");
//        } else {
//            print_r($password);
//        }
        return $this->verify_password_hash($password, $hash);

    }

    /**
     * get_user_id_from_username function.
     *
     * @access public
     * @param mixed $username
     * @return int the user id
     */
    public function get_user_id_from_username($username)
    {

        $this->db->select('user_id');
        $this->db->from('tbl_user');
        $this->db->where('user_name', $username);
        return $this->db->get()->row('user_id');

    }

    /**
     * get_user function.
     *
     * @access public
     * @param mixed $user_id
     * @return object the user object
     */
    public function get_user($user_id)
    {

        $this->db->from('tbl_user');
        $this->db->where('user_id', $user_id);
        return $this->db->get()->row();

    }

    public function get_institutionsByDistrict()
    {
        $resultData = array();
        $this->db->select('institution_district');
        $this->db->from('tbl_institution');
        $this->db->group_by('institution_district');
        $resultDistricts = $this->db->get();
        $resultDistricts = $resultDistricts->result_array();

        $this->db->select('institution_code,institution_name,institution_district');
        $this->db->from('tbl_institution');
        $this->db->order_by('institution_district');
        $resultInstitutions = $this->db->get();
        $resultInstitutions = $resultInstitutions->result_array();
        foreach ($resultDistricts as $resultDistrict) {
            $district = $resultDistrict['institution_district'];
            $sortedArray = array();
            foreach ($resultInstitutions as $resultInstitution) {
                if ($resultInstitution['institution_district'] == $district) {
                    $institution_name = $resultInstitution['institution_name'];
                    $institution_id = $resultInstitution['institution_code'];
                    $temp = array("id" => $institution_id, "name" => $institution_name);
                    array_push($sortedArray, $temp);
                }
            }
            array_push($resultData, array($district => $sortedArray));
        }
        return $resultData;
    }

    public function fetchCourses($institution_id)
    {
        $resultData = array();
        $courseCodes= array();
        $this->db->select('course_code');
        $this->db->from('tbl_instdata');
        $this->db->where('institution_code', $institution_id);
        $resultDistricts = $this->db->get();
        $resultDistricts = $resultDistricts->result_array();
        foreach ($resultDistricts as $row)
        {
            $courseCodes[]=$row['course_code'];
        }

        $this->db->select('course_id,course_code');
        $this->db->from('tbl_department');
        $this->db->join('tbl_courses', 'tbl_department.department_course = tbl_courses.course_id');
        $this->db->group_by('department_course');
        $this->db->where_in('department_code', $courseCodes);
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

    /**
     * hash_password function.
     *
     * @access private
     * @param mixed $password
     * @return string|bool could be a string on success, or bool false on failure
     */
    private function hash_password($password)
    {

        return password_hash($password, PASSWORD_BCRYPT);

    }

    /**
     * verify_password_hash function.
     *
     * @access private
     * @param mixed $password
     * @param mixed $hash
     * @return bool
     */
    private function verify_password_hash($password, $hash)
    {

        return password_verify($password, $hash);

    }
}