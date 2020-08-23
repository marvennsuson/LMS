<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teachertimeline_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }


  public function GetSubject_teacher(){
        $userID  = $this->session->userdata('user_id');
      $query =  $this->db->query("SELECT DISTINCT tbl_subjects.subjectcode ,tbl_subjects.subject_name FROM tbl_subjects WHERE tbl_subjects.teacher_code = '".$userID."' GROUP BY tbl_subjects.subject_name DESC");
      return $query;
  }

  public function InsertTimeline($data){
    $query = $this->db->insert('tbl_timeline' ,$data);
    return $query;
  }
public function GetAllTeacher(){
          $userID  = $this->session->userdata('user_id');
$query = $this->db->query("SELECT * FROM tbl_users RIGHT JOIN tbl_user_roles ON tbl_users.role =  tbl_user_roles.role_id WHERE  tbl_users.role = 3  AND tbl_users.user_id != '".$userID."' ORDER BY tbl_users.created_at DESC");
return $query;
}

  // public function GetMyTimelinePost($userID){
  // $query = $this->db->query('SELECT tbl_timeline.timeline_id ,
  //   tbl_timeline.title ,
  //   tbl_timeline.description ,
  //   tbl_timeline.created_at ,
  //   tbl_users.firstname,
  //   tbl_users.lastname,
  //   tbl_users.email FROM tbl_timeline INNER JOIN tbl_users ON tbl_timeline.user_id = tbl_users.user_id WHERE tbl_users.user_id = '. $userID.' AND disabled IS NULL ORDER BY tbl_timeline.created_at DESC LIMIT 10
  // ');
  //       return $query;
  // }




//   public function GetAllTimelinePost(){
//     // $query = $this->db->query('SELECT DISTINCT tbl_timeline.timeline_id ,
//     // tbl_timeline.title ,
//     // tbl_timeline.description ,
//     // tbl_timeline.created_at ,
//     // tbl_users.firstname,
//     // tbl_users.lastname,
//     // tbl_users.email,
//     // tbl_user_roles.role_display_name
//     // FROM tbl_timeline INNER JOIN tbl_users ON tbl_timeline.user_id = tbl_users.user_id  LEFT JOIN tbl_user_roles ON tbl_users.role = tbl_user_roles.role_id  WHERE tbl_timeline.disabled IS NULL ORDER BY created_at DESC LIMIT 5');
//     //       return $query;
// }

public function get_countTimelinePost()
{
      $userID = $this->session->userdata('user_id');
    $this->db->where('tbl_timeline.reciever_id',$userID);
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
    $this->db->where('tbl_timeline.reciever_id',$userID);
    $this->db->where('tbl_timeline.disabled IS NULL');
    $this->db->order_by('tbl_timeline.created_at', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
      return $query;
}


  public function DeleteTimelinepost($TimelineID,$userID){
    $query = $this->db->query("DELETE  FROM  tbl_timeline WHERE tbl_timeline.timeline_id = '". $TimelineID."' AND tbl_timeline.user_id = '". $userID."'");
    if($query == true){
            $query1 = $this->db->query("DELETE  FROM  tbl_comment WHERE tbl_comment.timeline_id = '".$TimelineID."'");
            return $query;
            return $query1;
    }else{
      return false;
    }
  }


  public function InsertComment($data){
      $query = $this->db->insert('tbl_comment',$data);
      return $query;
  }
  //
  // public function GetcommentPost(){
  //     $query = $this->db->query(" SELECT DISTINCT tbl_comment.comment_id , tbl_comment.description , tbl_comment.images, tbl_comment.created_at, tbl_users.email, tbl_users.firstname, tbl_users.middlename, tbl_users.lastname FROM tbl_comment RIGHT JOIN tbl_users ON tbl_comment.user_id = tbl_users.user_id WHERE tbl_comment.timeline_id = 105 ORDER BY tbl_comment.created_at DESC LIMIT 5 ");
  //     return $query ;
  // }

}
