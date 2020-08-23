<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Virtuallesson_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }

public function GetSubject(){
$TeacherId =  $this->session->userdata('user_id');
$query = $this->db->query("SELECT DISTINCT tbl_subjects.subjectcode,tbl_subjects.subject_name FROM tbl_subjects WHERE tbl_subjects.teacher_code = '".$TeacherId."' GROUP BY tbl_subjects.subject_name DESC");
return $query;

}

public function InsertLesson($data){
  $query = $this->db->insert('tbl_videolesson',$data);
return $query;
}

public function GetVideoLinkList(){
  $TeacherId =  $this->session->userdata('user_id');
  $query = $this->db->query("SELECT DISTINCT tbl_videolesson.id,
tbl_videolesson.lesson_number,
tbl_videolesson.lesson_topic,
tbl_videolesson.lesson_instruct,
tbl_videolesson.youtube_link,
tbl_videolesson.created_at ,
tbl_subjects.subject_name FROM tbl_videolesson RIGHT JOIN  tbl_subjects ON tbl_videolesson.Subject_code = tbl_subjects.subjectcode WHERE tbl_videolesson.Teacher_id = '".$TeacherId."'  ORDER BY tbl_videolesson.created_at DESC");
return $query;
}

public function GetSpecificVideo($data){
    $TeacherId =  $this->session->userdata('user_id');
$query = $this->db->query("SELECT DISTINCT tbl_videolesson.id,
tbl_videolesson.lesson_number,
tbl_videolesson.lesson_topic,
tbl_videolesson.lesson_instruct,
tbl_videolesson.youtube_link,
tbl_videolesson.created_at ,
tbl_subjects.subject_name  ,tbl_videolesson.Subject_code FROM tbl_videolesson RIGHT JOIN  tbl_subjects ON tbl_videolesson.Subject_code = tbl_subjects.subjectcode WHERE tbl_videolesson.Teacher_id = '".$TeacherId."' AND tbl_videolesson.id = '".$data."' ");

$result = ($query->num_rows() > 0 ) ? $query->result_array() : FALSE;

return $result;
}

public function UpdateData($data,$subject,$id){
      $TeacherId =  $this->session->userdata('user_id');
  $this->db->set($data);
  $this->db->where(['Teacher_id'=> $TeacherId , 'Subject_code'=> $subject , 'id' => $id]);
$query =  $this->db->update('tbl_videolesson');
return $query;
}

public function Deletelesson($lessonID,$teachId){
  $query = $this->db->query("DELETE FROM  tbl_videolesson WHERE tbl_videolesson.id = '".$lessonID."' AND tbl_videolesson.Teacher_id = '".$teachId."' ");
  return $query;

}

}
