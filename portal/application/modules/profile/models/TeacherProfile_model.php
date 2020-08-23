<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TeacherProfile_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }

public function GetClass(){
          $userID = $this->session->userdata('user_id');
          $query = $this->db->query("SELECT DISTINCT tbl_subjects.id, tbl_subjects.subjectcode, tbl_subjects.subject_name FROM tbl_subjects WHERE tbl_subjects.teacher_code = '".$userID."' GROUP BY tbl_subjects.subject_name DESC");
          $result = ($query->num_rows() > 0) ? $query->result() : FALSE;
          return $result;
}
public function getResiter($data){
    $userID = $this->session->userdata('user_id');
$query = $this->db->query("SELECT DISTINCT tbl_subjects.classcode,
tbl_subjects.section,
tbl_subjects.schedule,
tbl_subjects.subject_name,
tbl_students.student_number,
tbl_students.firstname,
tbl_students.middlename,
tbl_students.lastname,
tbl_students.avatar
FROM tbl_students LEFT JOIN tbl_subjects ON tbl_subjects.student_id = tbl_students.student_number WHERE tbl_subjects.teacher_code = '".$userID."' AND tbl_subjects.subjectcode = '".$data."' GROUP BY tbl_students.student_number DESC");
return $query;
}



public function GetInformation($userID){
  $query = $this->db->query("SELECT DISTINCT tbl_teacher_info.teacher_id,
tbl_teacher_info.name,
tbl_teacher_info.email,
tbl_teacher_info.address,
tbl_teacher_info.age,
tbl_teacher_info.birthday,
tbl_teacher_info.gender,
tbl_teacher_info.mobile,
tbl_user_roles.role_display_name
FROM tbl_teacher_info LEFT JOIN tbl_users ON  tbl_teacher_info.staffcode = tbl_users.user_id INNER JOIN tbl_user_roles ON tbl_user_roles.role_id =  tbl_users.role WHERE tbl_users.user_id = '".$userID."' ");
  return $query;
}
public function UpdatePassword($data,$userID){
  $this->db->set($data);
  $this->db->where('user_id', $userID);
  $query= $this->db->update('tbl_users');
  return $query;

}


public function UpdateProfile($data,$userID){
  $this->db->set($data);
  $this->db->where('staffcode', $userID);
  $query= $this->db->update('tbl_teacher_info');
  return $query;

}




public function get_countTimelinePost()
{
      $userID = $this->session->userdata('user_id');
    $this->db->where('tbl_timeline.user_id',$userID);
    $this->db->from('tbl_timeline');
    return  $this->db->count_all_results();
}

    public function GetAllTimelinePost($limit, $start)
{
      $userID = $this->session->userdata('user_id');
    $this->db->select('tbl_timeline.timeline_id ,
    tbl_timeline.title,
    tbl_timeline.description,
    tbl_timeline.created_at,
    tbl_teacher_info.email,
    tbl_teacher_info.name,
    tbl_subjects.subject_name,
    tbl_user_roles.role_display_name');
    $this->db->distinct();
    $this->db->from('tbl_subjects');
      $this->db->join('tbl_timeline', 'tbl_subjects.subjectcode = tbl_timeline.subject_code ', 'right');
    $this->db->join('tbl_teacher_info', 'tbl_timeline.user_id = tbl_teacher_info.staffcode ', 'left');
    $this->db->join('tbl_user_roles', 'tbl_teacher_info.role = tbl_user_roles.role_id', 'left');
    $this->db->where('tbl_timeline.user_id',$userID);
  
    $this->db->where('tbl_timeline.disabled IS NULL');
    $this->db->order_by('tbl_timeline.created_at', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
      return $query;
}

}
