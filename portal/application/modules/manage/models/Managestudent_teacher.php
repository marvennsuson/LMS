<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Managestudent_teacher extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();

  }
  public function GetSubjectByteacher($userID){
    $query = $this->db->query(" SELECT DISTINCT tbl_subjects.subjectcode,
tbl_subjects.subject_name
FROM tbl_subjects RIGHT JOIN tbl_users ON tbl_subjects.teacher_code = tbl_users.user_id WHERE tbl_users.user_id = '".$userID."' GROUP BY tbl_subjects.subject_name DESC ");
    return $query;

  }
  public function GetStudent(){
      $query = $this->db->query("SELECT DISTINCT
tbl_students.student_number,
tbl_students.firstname,
tbl_students.middlename,
tbl_students.lastname,
tbl_students.student_type,
tbl_students.status,
  tbl_students.grade,
tbl_students.course,
tbl_students.strand FROM tbl_students  WHERE  tbl_students.student_number IS NOT NULL AND tbl_students.student_number  != 0");
      return $query;

  }

  public function RegisterStudent_model($data){
$query = $this->db->insert("tbl_subjects",$data );
return $query;
  }


  public function GetBysubCode($subjcodeID){
    $query  = $this->db->query("SELECT DISTINCT tbl_subjects.subjectcode,
      tbl_subjects.classcode,
      tbl_subjects.subject_name,
       	tbl_subjects.section,
        tbl_subjects.schedule,
        tbl_subjects.adviser_teacher,
        tbl_subjects.subject_description
        FROM tbl_subjects WHERE tbl_subjects.subjectcode = '".$subjcodeID."' GROUP BY tbl_subjects.subjectcode DESC");
    return $query;
  }




}
