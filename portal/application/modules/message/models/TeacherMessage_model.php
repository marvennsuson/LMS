<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TeacherMessage_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->database();
  }

  // public function Getcategory(){
  //   $query = $this->db->query('SELECT * FROM tbl_user_roles WHERE role_id >= 2  ');
  //   return $query;
  // }
  // public function GetAllClassRegister(){
  //     $query = $this->db->query('SELECT * FROM tbl_classes');
  //     return $query;
  // }

  // public function GetRoleUserCateg($params = array()){
  //   if(array_key_exists("conditions",$params)){
  //       foreach ($params['conditions'] as $key => $value) {
  //         $query = $this->db->query("SELECT * FROM tbl_users WHERE role =  '".$value."'");
  //       }
  //   }
  //   $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
  //   return $result;
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

public function GetSubject(){
$userID = $this->session->userdata('user_id');
$query = $this->db->query("SELECT DISTINCT
tbl_subjects.subjectcode,
tbl_subjects.subject_name
FROM tbl_subjects LEFT JOIN tbl_users ON tbl_subjects.teacher_code = tbl_users.user_id WHERE tbl_users.user_id = '".$userID."'");
return $query;

}

public function GetSpecificSubcode($params = array()){
if(array_key_exists("conditions",$params)){
foreach ($params['conditions'] as $key => $value) {
$query = $this->db->query("SELECT * FROM tbl_subjects WHERE tbl_subjects.subject_id = '".$value."' ORDER BY tbl_subjects.subject_id");
}
}
$result = ($query->num_rows() > 0)?$query->result_array():FALSE;
return $result;
}


public function GetSubCode($params = array()){
if(array_key_exists("conditions",$params)){
foreach ($params['conditions'] as $key => $value) {
$query = $this->db->query("SELECT DISTINCT tbl_subjects.subject_id ,
tbl_subjects.subject_name FROM tbl_subjects RIGHT JOIN tbl_classes ON tbl_classes.classes_id = tbl_subjects.classcode_id WHERE tbl_classes.classes_id = '".$value."'  ORDER BY tbl_subjects.created_at DESC LIMIT 5");
}
}
$result = ($query->num_rows() > 0)?$query->result_array():FALSE;
return $result;
}


public function CreateMessage_model($data){
$query = $this->db->insert('tbl_message', $data);
}




    // ********************* START RECIEVE MESSAGE  *****************************/

function Count_all_messageisNULL($userEmail)
{
 return $this->db->where(['reciever_email'=>$userEmail,'tbl_message.reciever_email !=' => '', 'tbl_message.disabled_reciever =' => null] )->from("tbl_message")->count_all_results();
}
public function Count_allRemoveMessageRecieve($userEmail)
{
return $this->db->where(['reciever_email'=>$userEmail,'tbl_message.reciever_email !=' => '', ' tbl_message.disabled_reciever ' => "1" ] )->from("tbl_message")->count_all_results();
}
function Count_all_messagesentisnull($userEmail)
{

return $this->db->where(['sender_email'=>$userEmail,'tbl_message.reciever_email !=' => '', 'tbl_message.disabled_sender ='=> null])->from("tbl_message")->count_all_results();
}
function Count_all_messagesentNOTnull($userEmail)
{
return $this->db->where(['sender_email'=>$userEmail,'tbl_message.reciever_email !=' => '', ' tbl_message.disabled_sender' => "1"] )->from("tbl_message")->count_all_results();
}


public function GetRecieveMessage($userEmail){
$this->db->select('tbl_message.message_id ,  tbl_message.sender_id,  tbl_message.title,tbl_message.description,tbl_message.created_at, tbl_users.email');
$this->db->distinct();
$this->db->from('tbl_message');
$this->db->join('tbl_users', 'tbl_message.sender_email = tbl_users.email', 'right');
$this->db->where('tbl_message.reciever_email ', $userEmail);
$this->db->where('tbl_message.disabled_reciever  IS NULL ');
$this->db->where('tbl_message.reciever_email != "" ');
$this->db->order_by('tbl_message.created_at', 'DESC');
// $this->db->limit($limit, $start);
$query = $this->db->get();
return $query;
}

public function DeleteRecieve_message($msgID,$userEmail){
  $query = $this->db->query("UPDATE tbl_message SET tbl_message.disabled_reciever = 1 WHERE   tbl_message.message_id = '".$msgID."' AND tbl_message.reciever_email = '".$userEmail."'");
  return $query;
}

public function GetDelMessage($userEmail){
$this->db->select('tbl_message.message_id ,tbl_message.title,tbl_message.description,tbl_message.created_at,tbl_users.email');
$this->db->distinct();
$this->db->from('tbl_message');
$this->db->join('tbl_users', 'tbl_message.sender_email = tbl_users.email', 'right');
$this->db->where('tbl_message.reciever_email', $userEmail);
$this->db->where('tbl_message.disabled_reciever IS NOT NULL');
$this->db->where('tbl_message.reciever_email != "" ');
$this->db->order_by('tbl_message.created_at', 'DESC');
// $this->db->limit($limit, $start);
$query = $this->db->get();
return $query;
}

public function DelRecieveMessage($msgID){
$query = $this->db->query("DELETE FROM tbl_message WHERE  tbl_message.message_id = '".$msgID."'");
return $query;

}

public function DoReplyMessage($data){
$query = $this->db->insert('tbl_ReplyMessage',$data);
return $query;
}


public function ViewMore_model($messageId,$userEmail){
$query = $this->db->query("SELECT DISTINCT tbl_message.message_id ,
tbl_message.sender_id,
tbl_message.title,
tbl_message.description,
tbl_message.created_at,
tbl_users.email
FROM tbl_message RIGHT JOIN tbl_users ON tbl_message.sender_email = tbl_users.email WHERE tbl_message.reciever_email = '".$userEmail."' AND tbl_message.message_id ='".$messageId."' AND tbl_message.disabled_reciever  IS NULL   ORDER BY tbl_message.created_at DESC");

return $query;
}

public function GetCommentPost($messageId){
$query = $this->db->query("SELECT DISTINCT tbl_ReplyMessage.reply_id,
tbl_ReplyMessage.description,
tbl_ReplyMessage.created_at,
tbl_users.email
FROM tbl_message
INNER JOIN tbl_ReplyMessage ON tbl_message.message_id = tbl_ReplyMessage.message_id
RIGHT JOIN  tbl_users ON tbl_ReplyMessage.sender_id = tbl_users.user_id
RIGHT JOIN tbl_user_roles ON tbl_user_roles.role_id = tbl_users.role WHERE tbl_ReplyMessage.message_id = '".$messageId."' ORDER BY tbl_ReplyMessage.created_at DESC LIMIT 5");
return $query;
}
    // ********************* END RECIEVE MESSAGE  *****************************/


// ******************MESSAGE SENT*********************/

public function GetMessageSent($userEmail){
  $query = $this->db->query("SELECT tbl_message.message_id,
tbl_message.title,
tbl_message.description,
tbl_message.created_at,
  tbl_users.email
 FROM tbl_message LEFT JOIN tbl_users ON tbl_message.reciever_email = tbl_users.email   WHERE tbl_message.sender_email  = '".$userEmail."' AND tbl_message.disabled_sender  IS NULL  AND  tbl_message.reciever_email != ''    ORDER BY tbl_message.created_at DESC  ");
  return $query;
}



public function RemoveMessage_model($msgID,$userEmail){
$query = $this->db->query("UPDATE tbl_message SET tbl_message.disabled_sender = 1 WHERE  tbl_message.sender_email = '".$userEmail."' AND tbl_message.message_id = '".$msgID."'");
return $query;
}


public function GetDeletedMessage($userEmail){
  $query = $this->db->query("SELECT tbl_message.message_id,
tbl_message.title,
tbl_message.description,
tbl_message.created_at,
    tbl_users.email FROM tbl_message LEFT JOIN tbl_users ON tbl_message.reciever_email = tbl_users.email WHERE tbl_message.sender_email  = '".$userEmail."'    AND tbl_message.disabled_sender IS NOT NULL   AND  tbl_message.reciever_email != ''    ORDER BY tbl_message.created_at DESC LIMIT 5");
  return $query;
}


public function DelMessage($msgID,$userEmail){
  $query = $this->db->query("DELETE FROM tbl_message WHERE  tbl_message.message_id = '".$msgID."' AND  tbl_message.sender_email = '".$userEmail."'");
  return $query;

}
// ******************END MESSAGE SENT*********************/

}
