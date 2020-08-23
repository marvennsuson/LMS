<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminMessage_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }

  function Count_all_messageisNULL()
  {
      $userEmail =  $this->session->userdata('email');
   return $this->db->where(['reciever_email'=>$userEmail,'tbl_message.reciever_email !=' => '', ' tbl_message.disabled_reciever =' => null] )->from("tbl_message")->count_all_results();
  }
  public function Count_allRemoveMessageRecieve()
  {
          $userEmail =  $this->session->userdata('email');
  return $this->db->where(['reciever_email'=>$userEmail, 'tbl_message.reciever_email !=' => '',' tbl_message.disabled_reciever' => "1" ] )->from("tbl_message")->count_all_results();
  }


  function CountSENTMESSAGE()
  {
      $userEmail =  $this->session->userdata('email');
   return $this->db->where(['sender_email'=>$userEmail,'tbl_message.reciever_email !=' => '', ' tbl_message.disabled_sender =' => null] )->from("tbl_message")->count_all_results();
  }

  public function CountRemoveMessage()
  {
          $userEmail =  $this->session->userdata('email');
  return $this->db->where(['sender_email'=>$userEmail,'tbl_message.reciever_email !=' => '', ' tbl_message.disabled_sender' => "1" ] )->from("tbl_message")->count_all_results();
  }
//     public function getRoleUser(){
// $query = $this->db->query('SELECT * FROM tbl_user_roles WHERE tbl_user_roles.role_id != 2');
//       return $query;
//     }
//     public function GetRoleUserCateg($params = array()){
//       if(array_key_exists("conditions",$params)){
//           foreach ($params['conditions'] as $key => $value) {
//             $query = $this->db->query("SELECT * FROM tbl_users WHERE role =  '".$value."'");
//           }
//       }
//       $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
//       return $result;
//     }
  public function GetRecieveMessageAdmin($userEmail){
      $query = $this->db->query("SELECT DISTINCT tbl_message.message_id ,
    tbl_message.sender_id,
    tbl_message.title,
    tbl_message.description,
    tbl_message.created_at,
    tbl_users.email
    FROM tbl_message RIGHT JOIN tbl_users ON tbl_message.sender_email = tbl_users.email WHERE tbl_message.reciever_email = '".$userEmail."' AND tbl_message.disabled_reciever  IS NULL AND  tbl_message.reciever_email != ''  ORDER BY tbl_message.created_at  DESC");
    return $query;
}


public function FetchRemovemessage($userEmail){
  $query = $this->db->query("SELECT tbl_message.message_id ,
tbl_message.title,
tbl_message.description,
tbl_message.created_at,
tbl_users.email
FROM tbl_message LEFT JOIN tbl_users ON tbl_message.sender_email = tbl_users.email WHERE tbl_message.reciever_email = '".$userEmail."'  AND  tbl_message.disabled_reciever IS NOT NULL  AND  tbl_message.reciever_email != ''    ORDER BY tbl_message.created_at DESC ");
  return $query;
}

public function PermaDeleteRecieve($messageID,$userEmail){
  $query = $this->db->query("DELETE FROM tbl_message WHERE  tbl_message.message_id = '".$messageID."' AND tbl_message.reciever_email = '".$userEmail."'");
  return $query;
}

public function FetchSentMessage($userEmail){
$query = $this->db->query("SELECT tbl_message.message_id ,
tbl_message.title,
tbl_message.description,
tbl_message.created_at,
tbl_users.email
FROM tbl_message LEFT JOIN tbl_users ON tbl_message.reciever_email = tbl_users.email WHERE tbl_message.disabled_sender IS NULL  AND  tbl_message.reciever_email != ''  AND tbl_message.sender_email = '".$userEmail."'  ORDER BY tbl_message.created_at DESC ");
return $query;
}

public function RemoveSentMessage($messageID,$userEmail){
  $query = $this->db->query("UPDATE tbl_message SET tbl_message.disabled_sender = 1  WHERE tbl_message.message_id = '".$messageID."' AND tbl_message.sender_email = '".$userEmail."'");
  return $query;
}


public function FetchRemoveSentMessage($userEmail){
$query = $this->db->query("SELECT tbl_message.message_id ,
tbl_message.title,
tbl_message.description,
tbl_message.created_at,
tbl_users.email
FROM tbl_message LEFT JOIN tbl_users ON  tbl_message.reciever_email  =  tbl_users.email WHERE  tbl_message.sender_email = '".$userEmail."' AND tbl_message.disabled_sender IS NOT NULL  AND  tbl_message.reciever_email != ''  ORDER BY tbl_message.created_at  DESC ");
return $query;
}


public function PermaDeleteSent($messageID,$userEmail){
  $query = $this->db->query("DELETE FROM tbl_message WHERE  tbl_message.message_id = '".$messageID."' AND tbl_message.sender_email = '".$userEmail."'");
  return $query;
}


public function InsertMessage($data){
  $query = $this->db->insert('tbl_message',$data);
  return $query;
}


function fetch_dataQ($data)
{
$this->db->like('email', $data);
$query = $this->db->get('tbl_users');
if($query->num_rows() > 0)
{
foreach($query->result_array() as $row)
{

$data = array();
$data = [
'label'  => $row["email"],
'value'  => $row["email"],

];
}
return $data;
}
}




}
