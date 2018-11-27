<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Data_model extends CI_Model
{
    public function __construct()
    {

        parent::__construct();
        $this->load->database();

    }

    public function insertData($tableName, $data)
    {
        if (isset($data) && count($data) > 0)
            return $this->db->insert($tableName, $data);
    }
}