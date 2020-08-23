<?php
class Migration_utilities extends CI_Model {

    public $db;
    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('nvac_lms_2020', TRUE);
    }
    
    function CreateJob($data)
    {
        $this->db->insert('tbl_jobs', $data);
    }

    function CreateJobCategory($data)
    {
        $this->db->insert('tbl_jobs_category', $data);
        return $this->db->insert_id();
    }
	
}        
