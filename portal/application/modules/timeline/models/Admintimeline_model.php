<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admintimeline_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }

  public function GetRoleCateg(){
  $query = $this->db->query("SELECT * FROM tbl_user_roles WHERE role_id != 2 ");
  return  $query;
  }


public function InsertTimeline($data){
$query = $this->db->insert('tbl_timeline',$data);
return $query;
}

//   public function GetAllTimelinePost(){
//     $query = $this->db->query('SELECT DISTINCT tbl_timeline.timeline_id ,
//     tbl_timeline.title ,
//     tbl_timeline.description ,
//     tbl_timeline.created_at ,
//     tbl_users.email,
//     tbl_user_roles.role_display_name
//     FROM tbl_timeline INNER JOIN tbl_users ON tbl_timeline.user_id = tbl_users.user_id  LEFT JOIN tbl_user_roles ON tbl_users.role = tbl_user_roles.role_id  WHERE tbl_timeline.disabled IS NULL ORDER BY created_at DESC');
//           return $query;
// }

public function GetAllTimelinePost($limit, $start)
{
$this->db->select('tbl_timeline.timeline_id ,
tbl_timeline.title ,
tbl_timeline.description ,
tbl_timeline.created_at ,
tbl_teacher_info.email,
tbl_teacher_info.name,
tbl_subjects.subject_name,
tbl_user_roles.role_display_name');
$this->db->distinct();
$this->db->from('tbl_subjects');
$this->db->join('tbl_timeline', 'tbl_subjects.subjectcode = tbl_timeline.subject_code ', 'right');
$this->db->join('tbl_teacher_info', 'tbl_timeline.user_id = tbl_teacher_info.staffcode ', 'left');
$this->db->join('tbl_user_roles', 'tbl_teacher_info.role = tbl_user_roles.role_id', 'left');
$this->db->where('tbl_timeline.disabled IS NULL');
$this->db->order_by('tbl_timeline.created_at', 'DESC');
$this->db->limit($limit, $start);
$query = $this->db->get();
  return $query;
}



public function get_countTimelinePost()
{
      return $this->db->count_all("tbl_timeline");
  }

public function GetRoleUserCateg($params = array()){
  if(array_key_exists("conditions",$params)){
      foreach ($params['conditions'] as $key => $value) {
        $query = $this->db->query("SELECT * FROM tbl_users WHERE role =  '".$value."'");
      }
  }
  $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
  return $result;
}

}
