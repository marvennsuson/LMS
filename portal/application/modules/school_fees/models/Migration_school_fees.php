<?php
class Migration_school_fees extends CI_Model {

    public $db;
    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('nvac_lms_2020', TRUE);
    }
    
    public function school_fees_list()
    {
        $this->db->select("tbl_payment_transaction.id,tbl_payment_transaction.student_id,tbl_students.firstname,tbl_students.middlename,tbl_students.lastname,tbl_payment_transaction.file,tbl_payment_transaction.description");
        $this->db->join('tbl_students', 'tbl_students.student_number = tbl_payment_transaction.student_id');
        $this->db->order_by("id", "desc");
        $query = $this->db->get("tbl_payment_transaction");
        return $query; 
    }

    function search_student($data)
    {
        $this->db->like('firstname', $data); 
        $this->db->or_like('middlename', $data);
        $this->db->or_like('lastname', $data);
        $this->db->or_like('student_number', $data);
        $this->db->or_like('grade', $data);
        $this->db->or_like('course', $data);
        $this->db->or_like('strand', $data);
        $this->db->or_like('student_type', $data);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get_where('tbl_students');
        return $query->result_array();
    }


    public function read_student($id)
    {
        $query = $this->db->get_where('tbl_students', array('student_number' => $id));
        return $query->row_array();
    }

    public function create_bill($billData)
    {
        $this->db->insert('tbl_payment_transaction',$billData);
    }
    
    public function get_all_school_fees()
    {
        $this->db->select('student_id,file,description');
        $query = $this->db->get('tbl_payment_transaction');
        return $query->result_array();
    }

    public function delete_school_fee($id)
    {
        $this->db->delete('tbl_payment_transaction', array('id' => $id));
    }

    public function delete_school_fee_student($studentId)
    {
        $this->db->delete('tbl_payment_transaction', array('student_id' => $studentId));
    }

    public function read_school_fee($id)
    {
        $this->db->select("tbl_payment_transaction.id,tbl_payment_transaction.student_id,tbl_students.firstname,tbl_students.middlename,tbl_students.lastname,tbl_payment_transaction.file,tbl_payment_transaction.description");
        $this->db->join('tbl_students', 'tbl_students.student_number = tbl_payment_transaction.student_id');
        $query = $this->db->get_where('tbl_payment_transaction', array('tbl_payment_transaction.id'=>$id));
        return $query->row_array();
    } 

    public function update_bill($upData,$id)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_payment_transaction', $upData);
    }

    public function update_bill_student_id($update, $studentId)
    {
        $this->db->where('student_id', $studentId);
        $this->db->update('tbl_payment_transaction', $update);
    }


    public function student_exist($id)
    {
        $this->db->where('student_id',$id);
        $query = $this->db->get('tbl_payment_transaction');
        if (!empty($query->row_array())) {
            return true;
        }else{
            return false;
        }
    }
}/* End of file */


