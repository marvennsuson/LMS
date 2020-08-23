<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClassStudent_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }


// public function GetClass($userID){
//   $query = $this->db->query("SELECT DISTINCT
// tbl_subjects.id,
// tbl_subjects.subjectcode,
// tbl_subjects.subject_name,
// tbl_subjects.classcode,
// tbl_subjects.section,
// tbl_subjects.schedule
// FROM tbl_subjects WHERE tbl_subjects.teacher_code = '".$userID."' GROUP BY tbl_subjects.classcode DESC ");
//   return $query;
// }


// public function GetSubject($params  = array(), $userID){
//   if(array_key_exists("conditions",$params) && is_array($params)){
//       foreach ($params["conditions"] as $key => $value) {
//         // $query = $this->db->query("SELECT DISTINCT  tbl_class.id,
//         // tbl_class.subjectcode,
//         // tbl_class.subjectname,
//         // tbl_class.blockclassid,
//         // tbl_class.section,
//         // tbl_class.schedule
//         // FROM tbl_class WHERE tbl_class.blockclassid = '".$value."'");
//         $array = array('tbl_class.blockclassid' => $value, 'tbl_class.teacherid' => $userID);
//         $this->db->select('tbl_class.id,
//         tbl_class.subjectcode,
//         tbl_class.subjectname,
//         tbl_class.blockclassid,
//         tbl_class.section,
//         tbl_class.schedule');
//         $this->db->distinct();
//         $this->db->from("tbl_class");
//         $this->db->where($array);
//       $query = $this->db->get();
//       }
//   }
//   $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
//   return $result;
// //       $query = $this->db->query("SELECT DISTINCT
// //     tbl_class.id,
// //     tbl_class.subjectcode,
// //     tbl_class.subjectname,
// //     tbl_class.blockclassid,
// //     tbl_class.section,
// //     tbl_class.schedule
// //     FROM tbl_class WHERE tbl_class.blockclassid = '".$value."' AND tbl_class.teacherid = '".$userID."' ");
// //       return $query;
//
// }
// public function GetSubjectCode($params = array(),$userID){
//   if(array_key_exists("conditions",$params)){
//       foreach ($params['conditions'] as $key => $value) {
//         $query = $this->db->query("SELECT DISTINCT
//                tbl_class.id,
//               tbl_class.subjectcode,
//              tbl_class.subjectname,
//               tbl_class.blockclassid,
//                 tbl_class.section,
//                  tbl_class.schedule
//          FROM tbl_class WHERE tbl_class.blockclassid = '".$value."' AND tbl_class.teacherid = '".$userID."'");
//       }
//   }
//   $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
//   return $result;
// }
public function getSubcode($userID){
    $query = $this->db->query("SELECT DISTINCT
  tbl_subjects.id,
  tbl_subjects.subjectcode,
  tbl_subjects.subject_name,
  tbl_subjects.classcode,
  tbl_subjects.section,
  tbl_subjects.schedule
  FROM tbl_subjects WHERE tbl_subjects.teacher_code = '".$userID."' GROUP BY tbl_subjects.subject_name DESC ");
    return $query;
}

public function GetListStudent($params = array(),$userID){
  if(array_key_exists("conditions",$params)){
      foreach ($params['conditions'] as $key => $value) {
        $query = $this->db->query("SELECT DISTINCT tbl_subjects.id,
      tbl_subjects.subjectcode,
      tbl_subjects.subject_name,
      tbl_subjects.section,
      tbl_subjects.schedule,
      tbl_students.firstname,
      tbl_students.middlename,
      tbl_students.lastname,
      tbl_students.grade,
      tbl_students.strand,
      tbl_students.course,
      tbl_students.student_type
      FROM tbl_subjects INNER JOIN tbl_students ON tbl_subjects.student_id = tbl_students.student_number WHERE tbl_subjects.teacher_code = '".$userID."' AND tbl_subjects.subjectcode = '".$value."' ");
      }
  }
  $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
  return $result;
}


// public function GetStudent($userID){
//   $query = $this->db->query("SELECT DISTINCT tbl_subjects.id,
// tbl_subjects.subjectcode,
// tbl_subjects.subject_name,
// tbl_subjects.section,
// tbl_subjects.schedule,
// tbl_students.firstname,
// tbl_students.middlename,
// tbl_students.lastname,
// tbl_students.grade,
// tbl_students.strand,
// tbl_students.course,
// tbl_students.student_type
// FROM tbl_subjects INNER JOIN tbl_students ON tbl_subjects.student_id = tbl_students.student_number WHERE tbl_subjects.teacher_code = '".$userID."'  ");
//   return $query;
// }


public function DropStudent($StudID,$teachId){
  $query = $this->db->query("DELETE FROM tbl_subjects WHERE tbl_subjects.id = '".$StudID."' AND tbl_subjects.teacher_code = '".$teachId."' ");
  return $query;

}
}
