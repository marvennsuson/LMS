<?php
class Migration_admission extends CI_Model {

    public $db;
    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('nvac_lms_2020', TRUE);
    }

    function insertAdmission($data)
    {
        $this->db->insert('tbl_admission', $data);
    }
}
