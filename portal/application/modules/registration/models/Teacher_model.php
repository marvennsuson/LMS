<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
  public function GetTeacherList(){
$query = $this->db->query("SELECT DISTINCT tbl_teacher_info.name,
tbl_teacher_info.email,
tbl_teacher_info.address,
tbl_teacher_info.age,
tbl_teacher_info.birthday,
tbl_teacher_info.mobile,
tbl_teacher_info.gender,
tbl_teacher_info.staffcode,
tbl_teacher_info.status
FROM tbl_teacher_info WHERE tbl_teacher_info.status = '' ORDER BY tbl_teacher_info.created_at ASC");
return $query;

  }

  public function FetchTeacherInfo($teachID){

    $query =$this->db->query("SELECT DISTINCT tbl_teacher_info.staffcode , tbl_teacher_info.email  FROM tbl_teacher_info WHERE tbl_teacher_info.staffcode = '".$teachID."'");
    $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
    return $result;

  }

  public function insertCredentialsTeacher($data){
    $query = $this->db->insert('tbl_users',$data);
    return $query;
  }

  public function updateStatusTeacher($teachID){
    $query = $this->db->query("UPDATE tbl_teacher_info SET tbl_teacher_info.status = 1 WHERE  tbl_teacher_info.staffcode = '".$teachID."'  ");
return $query;
  }


}
