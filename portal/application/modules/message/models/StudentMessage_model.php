<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentMessage_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }
  function Count_all_messageisNULL()
  {
      $userEmail =  $this->session->userdata('email');
   return $this->db->where(['reciever_email'=>$userEmail,'tbl_message.reciever_email !=' => '','tbl_message.disabled_reciever =' => null] )->from("tbl_message")->count_all_results();
  }
  public function Count_allRemoveMessageRecieve()
  {
          $userEmail =  $this->session->userdata('email');
  return $this->db->where(['reciever_email'=>$userEmail,'tbl_message.reciever_email !=' => '', ' tbl_message.disabled_reciever' => "1" ] )->from("tbl_message")->count_all_results();
  }


public function Count_Sent_messageISNULL(){
  $userEmail =  $this->session->userdata('email');
return $this->db->where(['sender_email'=>$userEmail,'tbl_message.reciever_email !=' => '', ' tbl_message.disabled_sender =' => null] )->from("tbl_message")->count_all_results();
}

public function Count_Sent_messageNOTNULL(){
  $userEmail =  $this->session->userdata('email');
return $this->db->where(['sender_email'=>$userEmail,'tbl_message.reciever_email !=' => '', ' tbl_message.disabled_sender' => "1" ] )->from("tbl_message")->count_all_results();
}

  // public function Getcategory(){
  //     $query = $this->db->query('SELECT DISTINCT tbl_users.user_id,
  //       tbl_users.email,tbl_user_roles.role_display_name FROM tbl_users RIGHT JOIN tbl_user_roles ON tbl_users.role = tbl_user_roles.role_id  WHERE  tbl_user_roles.role_id >= 2  ORDER BY tbl_users.email DESC ');
  //     return $query;
  // }

  function fetch_data($query)
  {
  $this->db->like('email', $query);
  $query = $this->db->get('tbl_users');
  if($query->num_rows() > 0)
  {
  foreach($query->result_array() as $row)
  {
  $data[] = array(
  'label'  => $row["email"],
  'value'  => $row["email"]

  );
  }
  return $data;
  }
  }

  public function CreateMessage($data){
    $query = $this->db->insert('tbl_message',$data);
    return $query;
  }



public function FetchMessageRecieve($userEmail){
  $query = $this->db->query("SELECT tbl_message.message_id ,
tbl_message.title,
tbl_message.description,
tbl_message.created_at,
tbl_users.email
FROM tbl_message LEFT JOIN tbl_users ON tbl_message.sender_email = tbl_users.email WHERE tbl_message.disabled_reciever IS NULL   AND tbl_message.reciever_email = '".$userEmail."'  AND  tbl_message.reciever_email != '' ORDER BY tbl_message.created_at DESC LIMIT 10");
  return $query;
}


public function RemoveRecieveMessage($messageID,$userEmail){
  $query = $this->db->query("UPDATE tbl_message SET tbl_message.disabled_reciever = 1  WHERE tbl_message.message_id = '".$messageID."' AND tbl_message.reciever_email = '".$userEmail."'");
  return $query;
}


public function FetchRemovemessage($userEmail){
  $query = $this->db->query("SELECT tbl_message.message_id ,
tbl_message.title,
tbl_message.description,
tbl_message.created_at,
tbl_users.email
FROM tbl_message LEFT JOIN tbl_users ON tbl_message.sender_email = tbl_users.email WHERE tbl_message.reciever_email = '".$userEmail."'  AND  tbl_message.disabled_reciever IS NOT NULL    AND  tbl_message.reciever_email != ''  ORDER BY tbl_message.created_at DESC LIMIT 10");
  return $query;
}



public function FetchSentMessage($userEmail){
$query = $this->db->query("SELECT tbl_message.message_id ,
tbl_message.title,
tbl_message.description,
tbl_message.created_at,
tbl_users.email
FROM tbl_message LEFT JOIN tbl_users ON tbl_message.reciever_email = tbl_users.email WHERE tbl_message.disabled_sender IS NULL AND tbl_message.sender_email = '".$userEmail."'  AND  tbl_message.reciever_email != '' ORDER BY tbl_message.created_at DESC LIMIT 10");
return $query;
}


public function FetchRemoveSentMessage($userEmail){
$query = $this->db->query("SELECT tbl_message.message_id ,
tbl_message.title,
tbl_message.description,
tbl_message.created_at,
tbl_users.email
FROM tbl_message LEFT JOIN tbl_users ON  tbl_message.reciever_email  =  tbl_users.email WHERE  tbl_message.sender_email = '".$userEmail."' AND tbl_message.disabled_sender IS NOT NULL  AND  tbl_message.reciever_email != '' ORDER BY tbl_message.created_at  DESC LIMIT 10");
return $query;
}

public function RemoveSentMessage($messageID,$userEmail){
  $query = $this->db->query("UPDATE tbl_message SET tbl_message.disabled_sender = 1  WHERE tbl_message.message_id = '".$messageID."' AND tbl_message.sender_email = '".$userEmail."'");
  return $query;
}


public function PermaDeleteRecieve($messageID,$userEmail){
  $query = $this->db->query("DELETE FROM tbl_message WHERE  tbl_message.message_id = '".$messageID."' AND tbl_message.reciever_email = '".$userEmail."'");
  return $query;
}


public function PermaDeleteSent($messageID,$userEmail){

  $query = $this->db->query("DELETE FROM tbl_message WHERE  tbl_message.message_id = '".$messageID."' AND tbl_message.sender_email = '".$userEmail."'");
  return $query;
}


public function ViewPost($messageID,$userEmail){

  $query = $this->db->query("SELECT DISTINCT tbl_message.message_id ,
tbl_message.sender_id,
tbl_message.title,
tbl_message.description,
tbl_message.created_at,
tbl_users.email
FROM tbl_message RIGHT JOIN tbl_users ON tbl_message.sender_email = tbl_users.email WHERE tbl_message.reciever_email = '".$userEmail."' AND tbl_message.message_id ='".$messageID."' AND tbl_message.disabled_reciever  IS NULL ");

return $query;

}

public function GetComment($messageID){
  $query = $this->db->query("SELECT DISTINCT tbl_ReplyMessage.reply_id,
  tbl_ReplyMessage.description,
  tbl_ReplyMessage.created_at,
  tbl_users.email

 FROM tbl_message
  INNER JOIN tbl_ReplyMessage ON tbl_message.message_id = tbl_ReplyMessage.message_id
  RIGHT JOIN  tbl_users ON tbl_ReplyMessage.sender_id = tbl_users.user_id
  RIGHT JOIN tbl_user_roles ON tbl_user_roles.role_id = tbl_users.role WHERE tbl_ReplyMessage.message_id = '".$messageID."' ORDER BY tbl_ReplyMessage.created_at DESC LIMIT 5");
  return $query;
}



public function DoReplyMessage($data){
$query = $this->db->insert('tbl_ReplyMessage',$data);
return $query;
}

}
