<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Studenttimeline_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
  public function GetCountTimeline()
  {
        $userID = $this->session->userdata('user_id');
        $this->db->select('time.timeline_id,
        time.title,
        time.description,
        time.created_at,
        role.role_display_name,
        subs.subject_name,
        tech.name');
        $this->db->distinct();
        $this->db->from('tbl_subjects as subs');
        $this->db->join('tbl_timeline as time', 'subs.subjectcode = time.subject_code ', 'right');
        $this->db->join('tbl_teacher_info as tech', 'tech.staffcode = time.user_id', 'left');
        $this->db->join('tbl_user_roles as role', 'tech.role = role.role_id', 'inner');
        $where = "subs.student_id = '$userID' OR time.reciever_id ='$userID'";
      $this->db->where($where);
      return  $this->db->count_all_results();
  }

  public function GetPostTeacher($limit, $start){
    $userID = $this->session->userdata('user_id');
//         $query = $this->db->query("SELECT DISTINCT
// tbl_timeline.timeline_id ,
//           tbl_timeline.title ,
//           tbl_timeline.description ,
//           tbl_timeline.created_at ,
//           tbl_user_roles.role_display_name,
//           tbl_subjects.subject_name,
//           tbl_teacher_info.name
//            FROM tbl_subjects RIGHT JOIN tbl_timeline ON tbl_subjects.subjectcode = tbl_timeline.subject_code
//            LEFT JOIN tbl_teacher_info ON tbl_teacher_info.staffcode = tbl_timeline.user_id
//            INNER JOIN tbl_user_roles ON tbl_teacher_info.role = tbl_user_roles.role_id WHERE tbl_subjects.student_id = '".$userID."' OR tbl_timeline.reciever_id ='".$userID."' ORDER BY tbl_timeline.created_at DESC");
//               return $query;
    $this->db->select('tbl_timeline.timeline_id,tbl_timeline.title,tbl_timeline.description,tbl_timeline.created_at,tbl_user_roles.role_display_name,tbl_subjects.subject_name,tbl_teacher_info.name');
    $this->db->distinct();
    $this->db->from('tbl_subjects');
    $this->db->join('tbl_timeline', 'tbl_subjects.subjectcode = tbl_timeline.subject_code ', 'right');
    $this->db->join('tbl_teacher_info', 'tbl_teacher_info.staffcode = tbl_timeline.user_id', 'left');
    $this->db->join('tbl_user_roles', 'tbl_teacher_info.role = tbl_user_roles.role_id', 'inner');
    $where = "tbl_subjects.student_id = '$userID' OR tbl_timeline.reciever_id ='$userID'";
    $this->db->where($where);
    $this->db->order_by('tbl_timeline.created_at', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
      return $query;
  }



  public function GetSpecifiPost($TimelineID){
    $query = $this->db->query('SELECT tbl_timeline.timeline_id ,
                                          tbl_timeline.title ,
                                          tbl_timeline.description ,
                                          tbl_timeline.created_at ,
                                          tbl_teacher_info.email,
                                          tbl_teacher_info.name,
                                          tbl_user_roles.role_display_name
                                          FROM tbl_timeline LEFT JOIN tbl_teacher_info ON tbl_timeline.user_id = tbl_teacher_info.staffcode  LEFT JOIN tbl_user_roles ON tbl_teacher_info.role = tbl_user_roles.role_id  WHERE  tbl_timeline.timeline_id = '.$TimelineID.' AND tbl_timeline.disabled IS NULL ORDER BY created_at ');
                                                return $query;

  }

  public function AddCommentPost($data){
    $query  = $this->db->insert('tbl_comment',$data);
    return $query;
  }

      public function GetCommentPost($TimelineID){
          $query = $this->db->query('SELECT tbl_comment.comment_id ,
                                      tbl_comment.timeline_id,
                                      tbl_comment.user_id,
                                      tbl_comment.description,
                                      tbl_comment.created_at,
                                      tbl_users.email,
                                            tbl_user_roles.role_display_name
                                      FROM  tbl_timeline INNER JOIN  tbl_comment  ON tbl_timeline.timeline_id = tbl_comment.timeline_id
                                      RIGHT JOIN tbl_users ON tbl_users.user_id = tbl_comment.user_id
                                      RIGHT JOIN tbl_user_roles ON tbl_user_roles.role_id = tbl_users.role  WHERE tbl_comment.timeline_id = '.$TimelineID.' ORDER BY tbl_comment.created_at DESC LIMIT 10');
                                      return $query;
      }

}
