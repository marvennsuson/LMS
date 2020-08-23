<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }

  public function GetStudentProfilemodel($userID){
$query  = $this->db->query("SELECT DISTINCT
tbl_users.email as userEmail,
tbl_users.password,
tbl_students.student_number,
tbl_students.student_type,
tbl_students.status,
tbl_students.grade,
tbl_students.strand,
tbl_students.course,
tbl_students.firstname,
tbl_students.middlename,
tbl_students.lastname,
tbl_students.birthdate,
tbl_students.sex,
tbl_students.address,
tbl_students.cellphone,
tbl_students.email,
	tbl_students.guardian_name,
  	tbl_students.guardian_mobile,
    tbl_students.guardian_email,
    	tbl_students.guardian_address,
tbl_students.created_at,
tbl_school_lvl.School_lvl_name,
year_lvl.year_lvl_name
FROM tbl_users
RIGHT JOIN tbl_students ON tbl_users.user_id = tbl_students.student_number
LEFT JOIN year_lvl ON year_lvl.year_lvl_id = tbl_students.grade RIGHT JOIN tbl_school_lvl ON tbl_school_lvl.school_lvl_id = year_lvl.school_lvl_id WHERE tbl_users.user_id = '".$userID."'");

// $result = ($query->num_rows() > 0)?$query->result():FALSE;
return $query;
  }

public function UpdateProfileStudent($data,$studID){
$this->db->set($data);
$this->db->where('student_number', $studID);
$query= $this->db->update('tbl_students');
return $query;
}

public function getScheduleStudent($userID){

  $query = $this->db->query("SELECT DISTINCT tbl_subjects.id,
tbl_subjects.subjectcode,
tbl_subjects.classcode,
tbl_subjects.subject_name,
tbl_subjects.teacher_code,
tbl_subjects.section,
tbl_subjects.schedule,
tbl_subjects.adviser_teacher,
tbl_subjects.student_id,
tbl_subjects.created_at,
tbl_teacher_info.teacher_id,
tbl_teacher_info.name,
tbl_teacher_info.email,
tbl_teacher_info.staffcode
 FROM tbl_users
 RIGHT JOIN tbl_subjects ON tbl_users.user_id = tbl_subjects.student_id
 LEFT JOIN tbl_teacher_info  ON tbl_subjects.teacher_code = tbl_teacher_info.staffcode  WHERE tbl_subjects.student_id = '".$userID."' ");
  return $query;

}


public function UpdatePassword($data,$userID){
  $this->db->set($data);
  $this->db->where('user_id', $userID);
  $query= $this->db->update('tbl_users');
  return $query;

}

public function valitadorPassword($userID){
          $query = $this->db->query("SELECT * FROM  tbl_users WHERE tbl_users.user_id = '".$userID."' ");
          return $query;
}


}
