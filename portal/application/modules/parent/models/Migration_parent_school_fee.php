<?php
class Migration_parent_school_fee extends CI_Model {

    public $db;
    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('nvac_lms_2020', TRUE);
    }
    
    public function get_all_child_info($parentEmail)
    {
        $this->db->where('guardian_email', $parentEmail);
        $query = $this->db->get('tbl_students');

        return $query->result_array();
    }

    public function get_child_student_fee($studentId){
        $this->db->select('tbl_payment_transaction.id, tbl_payment_transaction.student_id, tbl_students.firstname, tbl_students.middlename, tbl_students.lastname, tbl_payment_transaction.file, tbl_payment_transaction.description');
        $this->db->join('tbl_students', 'tbl_students.student_number = tbl_payment_transaction.student_id');
        $this->db->where('student_id', $studentId);
        $query = $this->db->get('tbl_payment_transaction');
        return $query->row_array(); 
    }
}/* End of file */


