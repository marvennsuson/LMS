<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }

  public function GetStudentNoLogin(){
    $query = $this->db->query("SELECT DISTINCT tbl_students.student_number,
tbl_students.student_type,
tbl_students.status,
tbl_students.grade,
tbl_students.strand,
tbl_students.course,
tbl_students.firstname,
tbl_students.middlename,
tbl_students.lastname,
tbl_students.sex,
tbl_students.cellphone,
tbl_students.email,
tbl_students.guardian_name,
tbl_students.guardian_mobile,
tbl_students.guardian_email,
tbl_students.avatar,
tbl_students.created_at
FROM tbl_students WHERE   tbl_students.status = '' ORDER BY tbl_students.created_at ASC");
return $query;
  }

  public function FetchStudentInfo($StudID){

    $query =$this->db->query("SELECT DISTINCT tbl_students.student_number , tbl_students.email ,tbl_students.guardian_email ,tbl_guardian.id FROM tbl_students LEFT JOIN tbl_guardian ON tbl_guardian.Student_number = tbl_students.student_number WHERE tbl_students.student_number = '".$StudID."'");
    $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
    return $result;

  }

  public function updateStatus($StudID){
    $query = $this->db->query("UPDATE tbl_students SET tbl_students.status = 1 WHERE  tbl_students.student_number = '".$StudID."'  ");
return $query;
  }
  public function updateGuardianStatus($StudID){
    $query = $this->db->query("UPDATE tbl_guardian SET tbl_guardian.status = 1 WHERE  tbl_guardian.Student_number = '".$StudID."'  ");
return $query;
  }

  public function insertCredentials($data){
    $query = $this->db->insert('tbl_users',$data);
    return $query;
  }

}
