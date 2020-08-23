<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('TeacherMessage_model');
    $this->load->model('StudentMessage_model');
    $this->load->helper('date');
    $this->load->model('AdminMessage_model');

  }

  function index()
  {
    if($this->session->userdata('user_id') != null) {
              if($this->session->role_id == 1)
              {

              }elseif($this->session->role_id == 2)
              {
                $this->Admin_messageIndex();
              }elseif($this->session->role_id == 3)
              {
                  $this->Teacher_messageIndex();
              }elseif($this->session->role_id == 4)
              {
                  $this->Student_messages();
              }else
              {

              }
} else {
        redirect(base_url(), 'refresh');
}
  }




// **************START OF STUDENT MESSAGE******************/
public function Student_messages(){
  if($this->session->userdata('user_id') != null) {
    $aside = array(
        'menu'  => 'dashboardStudent',
        'submenu'     => 'message',
    );
    $this->session->set_flashdata($aside);
        $userEmail =  $this->session->userdata('email');
        $userID =  $this->session->userdata('user_id');

      $data['CountInboxRecieve'] =   $this->StudentMessage_model->Count_all_messageisNULL();
      $data['CountInboxRemove'] =   $this->StudentMessage_model->Count_allRemoveMessageRecieve();

      $data['CountSentMessage'] =   $this->StudentMessage_model->Count_Sent_messageISNULL();
      $data['CountSentRemove'] =   $this->StudentMessage_model->Count_Sent_messageNOTNULL();

      $data['MessageSentRemoveList'] = $this->StudentMessage_model->FetchRemoveSentMessage($userEmail);
      $data['MessageSentList'] = $this->StudentMessage_model->FetchSentMessage($userEmail);
      $data['MessageRemoveList'] = $this->StudentMessage_model->FetchRemovemessage($userEmail);
      $data['messageRecievelist'] = $this->StudentMessage_model->FetchMessageRecieve($userEmail);
      // $data['GetCategoryList'] = $this->StudentMessage_model->Getcategory();
      $data['title'] = "Student Message - NVAC Portal";
      $this->load->view('includes/_wrapper_start');
      $this->load->view('includes/_navbar');
      $this->load->view('includes/_aside');
      $this->load->view('Student_message', $data);
      $this->load->view('includes/_footer');
  $this->load->view('includes/_wrapper_end');
} else {
      redirect(base_url(), 'refresh');
}
}

function fetchStudent()
{
$data = $this->input->post('query');
echo json_encode($this->StudentMessage_model->fetch_data($data));
}

public function SendMessageStudent(){
if($this->session->userdata('user_id') != null) {

$config = array(
        array(
                'field' => 'message_title',
                'label' => 'Title',
                'rules' => 'required'
        ),
        array(
                'field' => 'message_text',
                'label' => 'Description',
                'rules' => 'required',

        ),

);
$this->form_validation->set_rules($config);
if ($this->form_validation->run() == FALSE)
         {
            $this->Student_messages();
         }
         else
         {
                  //   $userEmail =  $this->session->userdata('email');
                  // $recieveID = $this->input->post('reciever_id');
                  //     for ($i=0; $i  <  count($recieveID); $i++) {
                  //       $data = [
                  //             'sender_email' => $this->session->userdata('email'),
                  //             'reciever_email'=> $recieveID[$i],
                  //             'title' =>  $this->input->post('message_title'),
                  //             'description' => $this->input->post('message_text'),
                  //             'created_at' => date('Y-m-d H:i:s',now())
                  //
                  //       ];
                  //             $this->StudentMessage_model->CreateMessage($data);
                  //     }
                  //
                  //       $this->session->set_flashdata('msg',"Message Sent Success");
                  //           $this->Student_messages();

                  // echo "<script>alert('Succesfully Sent');</script>";
                  //       redirect(base_url(), 'refresh');

                  $inputdata  = $this->input->post('sendto');
                  if(! empty($inputdata)){

                  foreach ($inputdata as $key => $value) {
                  $valueofdata  = strval($value);

                  }
                  $explode = explode(",",$valueofdata);
                  // $stringdata = preg_replace('/\s+/', '', $explode);

                  for ($i=0; $i < count($explode); $i++) {
                  $data = [
                  'sender_email' => $this->session->userdata('email'),
                  'reciever_email' => $explode[$i],
                  'title' => $this->input->post('message_title'),
                  'description' => $this->input->post('message_text'),
                  'created_at' => date('Y-m-d H:i:s',now())
                  ];
                  $this->TeacherMessage_model->CreateMessage_model($data);
                  }
                  }

         }


} else {
  redirect(base_url(), 'refresh');
}
}
public function StudentViewMessage(){
if($this->session->userdata('user_id') != null) {
      $userEmail =  $this->session->userdata('email');
  $userID   =    $this->session->userdata('user_id');
  $messageID = $this->uri->segment(4);
  $data['getPost']   =  $this->StudentMessage_model->ViewPost($messageID,$userEmail);
  $data['getComment'] = $this->StudentMessage_model->GetComment($messageID);
      $data['title'] = "Student Message - NVAC Portal";
      $this->load->view('includes/_wrapper_start');
      $this->load->view('includes/_navbar');
      $this->load->view('includes/_aside');
      $this->load->view('Readmorepost_student', $data);
      $this->load->view('includes/_footer');
  $this->load->view('includes/_wrapper_end');
} else {
    redirect(base_url(), 'refresh');
}
}
public function StudentReplyMessage(){
  if($this->session->userdata('user_id') != null) {
  $config = array(
          array(
                  'field' => 'relpy_message',
                  'label' => 'Message',
                  'rules' => 'required'
          ),

  );
  $this->form_validation->set_rules($config);
  if ($this->form_validation->run() == FALSE)
           {
             if($this->session->userdata('user_id') != null) {
                     $userEmail =  $this->session->userdata('email');
               $userID   =    $this->session->userdata('user_id');
                     $messageID =  $this->input->post('message_id');
               // $messageID = $this->uri->segment(4);
               $data['getPost']   =  $this->StudentMessage_model->ViewPost($messageID,$userEmail);
               $data['getComment'] = $this->StudentMessage_model->GetComment($messageID);
                   $data['title'] = "Student Message - NVAC Portal";
                   $this->load->view('includes/_wrapper_start');
                   $this->load->view('includes/_navbar');
                   $this->load->view('includes/_aside');
                   $this->load->view('Readmorepost_student', $data);
                   $this->load->view('includes/_footer');
               $this->load->view('includes/_wrapper_end');
             } else {
                 redirect(base_url(), 'refresh');
             }
           }
           else
           {
              $data = [
                    'message_id' => $this->input->post('message_id'),
                      'sender_id' => $this->session->userdata('user_id'),
                      'reciever_id' =>   $this->input->post('reciever_id'),
                      'description' =>  $this->input->post('relpy_message'),
                    'created_at' => date('Y-m-d H:i:s',now())
              ];

                  $this->TeacherMessage_model->DoReplyMessage($data);
                  echo "<script>alert('Succesfully Sent Reply Message');</script>";
           }
         } else {
             redirect(base_url(), 'refresh');
         }
}

public function StudentDeleteInbox(){
  if($this->session->userdata('user_id') != null) {
$messageID  = $this->input->post('checkbox_value');
  $userID = $this->session->userdata('user_id');
         $userEmail =  $this->session->userdata('email');
  for ($i=0; $i < count($messageID) ; $i++) {
  $this->StudentMessage_model->RemoveRecieveMessage($messageID[$i],$userEmail);
  }
 $this->session->set_flashdata('msg',"Deleted Success");
        echo "<script>alert('Deleted Success');</script>";
        $this->Student_messages();
} else {
      redirect(base_url(), 'refresh');
}
}

public function StudentDeleteSent(){
  if($this->session->userdata('user_id') != null) {
$messageID  = $this->input->post('checkbox_value');
  $userID = $this->session->userdata('user_id');
           $userEmail =  $this->session->userdata('email');
for ($i=0; $i < count($messageID); $i++) {
  $this->StudentMessage_model->RemoveSentMessage($messageID[$i],$userEmail);
}
 $this->session->set_flashdata('msg',"Deleted Success");
        echo "<script>alert('Deleted Success');</script>";
        $this->Student_messages();
} else {
      redirect(base_url(), 'refresh');
}
}

// PERMANNENT DELETED
public function DeleteMessageRecieve(){
if($this->session->userdata('user_id') != null) {
$messageID  = $this->uri->segment(4);
         $userEmail =  $this->session->userdata('email');
$userID = $this->session->userdata('user_id');
$this->StudentMessage_model->PermaDeleteRecieve($messageID,$userEmail);
$this->session->set_flashdata('msg',"Deleted Permanently Success");
      echo "<script>alert('Deleted Success');</script>";
      $this->Student_messages();
} else {
    redirect(base_url(), 'refresh');
}
}


public function PermanDeleteMessageSent(){
if($this->session->userdata('user_id') != null) {
$messageID  = $this->uri->segment(4);
       $userEmail =  $this->session->userdata('email');
$userID = $this->session->userdata('user_id');
$this->StudentMessage_model->PermaDeleteSent($messageID,$userEmail);
$this->session->set_flashdata('msg',"Deleted Permanently Success");
      echo "<script>alert('Deleted Success');</script>";
      $this->Student_messages();
} else {
    redirect(base_url(), 'refresh');
}
}

// END PERMANENT DELETED



// **************END OF STUDENT MESSAGE******************/











// **************START OF TEACHER MESSAGE******************/

public function Teacher_messageIndex(){
if($this->session->userdata('user_id') != null) {

$aside = array(
'menu'  => 'dashboardteacher',
'submenu'     => 'message',
);
$this->session->set_flashdata($aside);
$userID  = $this->session->userdata('user_id');
$userEmail  = $this->session->userdata('email');
$data = array();
$data['title'] = "Teacher Message - NVAC Portal";
$data["countmessageRecieve"] = $this->TeacherMessage_model->Count_all_messageisNULL($userEmail);
$data["CountRemoveRecieve"] = $this->TeacherMessage_model->Count_allRemoveMessageRecieve($userEmail);

$data["countmessagesent"] = $this->TeacherMessage_model->Count_all_messagesentisnull($userEmail);
$data["countRemoveSent"] = $this->TeacherMessage_model->Count_all_messagesentNOTnull($userEmail);

$data['messageRecieve'] = $this->TeacherMessage_model->GetRecieveMessage($userEmail);

$data['SubjectCodelist'] = $this->TeacherMessage_model->GetSubject();


$data['messagesentlist'] = $this->TeacherMessage_model->GetMessageSent($userEmail);

$this->load->view('includes/_wrapper_start');
$this->load->view('includes/_navbar');
$this->load->view('includes/_aside');
$this->load->view('Teacher_messageIndex', $data);
$this->load->view('includes/_footer');
$this->load->view('includes/_wrapper_end');
} else {
redirect(base_url(), 'refresh');
}
}

public function ReceiveRemoveInboxview(){
if($this->session->userdata('user_id') != null) {
$userEmail  = $this->session->userdata('email');
$data['title'] = "Teacher Message - NVAC Portal";
$data['DelMessageRecieve'] = $this->TeacherMessage_model->GetDelMessage($userEmail);
$this->load->view('includes/_wrapper_start');
$this->load->view('includes/_navbar');
$this->load->view('includes/_aside');
$this->load->view('Teacher/RemoveMessageInbox', $data);
$this->load->view('includes/_footer');
$this->load->view('includes/_wrapper_end');
} else {
redirect(base_url(), 'refresh');
}
}

public function SentRemoveMessageview(){

if($this->session->userdata('user_id') != null) {
$userEmail  = $this->session->userdata('email');
$data['title'] = "Teacher Message - NVAC Portal";
$data['messageDelete'] =  $this->TeacherMessage_model->GetDeletedMessage($userEmail);
$this->load->view('includes/_wrapper_start');
$this->load->view('includes/_navbar');
$this->load->view('includes/_aside');
$this->load->view('Teacher/RemoveMessageSent', $data);
$this->load->view('includes/_footer');
$this->load->view('includes/_wrapper_end');
} else {
redirect(base_url(), 'refresh');
}
}

function fetch()
{
$data = $this->input->post('query');
echo json_encode($this->TeacherMessage_model->fetch_data($data));
}

public function CreateMessage_teacher(){
$config = array(
array(
'field' => 'texttitle',
'label' => 'Title',
'rules' => 'required'
),
array(
'field' => 'textmessage',
'label' => 'Description',
'rules' => 'required',

),
);
$this->form_validation->set_rules($config);
if ($this->form_validation->run() == FALSE)
{
$this->Teacher_messageIndex();
}
else
{

$bysubID  =   $this->input->post('bySubcode');
$inputdata  = $this->input->post('sendto');
if(! empty($inputdata)){

foreach ($inputdata as $key => $value) {
$valueofdata  = strval($value);

}
$explode = explode(",",$valueofdata);
// $stringdata = preg_replace('/\s+/', '', $explode);

for ($i=0; $i < count($explode); $i++) {
$data = [
'sender_email' => $this->session->userdata('email'),
'reciever_email' => $explode[$i],
'title' => $this->input->post('texttitle'),
'description' => $this->input->post('textmessage'),
'created_at' => date('Y-m-d H:i:s',now())
];
$this->TeacherMessage_model->CreateMessage_model($data);
}
}elseif(! empty($bysubID) ){
$data = [
'sender_email' => $this->session->userdata('email'),
'subject_id' =>  $bysubID,
'title' => $this->input->post('texttitle'),
'description' => $this->input->post('textmessage'),
'created_at' => date('Y-m-d H:i:s',now())
];
$this->TeacherMessage_model->CreateMessage_model($data);

}else{
echo "false";
}


}
}
// **************END OF TEACHER MESSAGE******************/
// *************************START TEACHER SENT MESSAGE***************************//////
public function RemoveTeacher_Message(){
if($this->session->userdata('user_id') != null) {
$userID = $this->session->userdata('user_id');
$userEmail = $this->session->userdata('email');
$msgID = $this->input->post('checkbox_value');

for ($i=0; $i < count($msgID); $i++) {
$this->TeacherMessage_model->RemoveMessage_model($msgID[$i],$userEmail);
}
echo "<script>alert('Succesfully Remove Message');</script>";
$this->Teacher_messageIndex();

} else {
redirect(base_url(), 'refresh');
}
}
public function DeleteMessage(){
if($this->session->userdata('user_id') != null) {
$userID = $this->session->userdata('user_id');
$userEmail = $this->session->userdata('email');
$msgID = $this->input->post('del_button');
$this->TeacherMessage_model->DelMessage($msgID,$userEmail);
} else {
redirect(base_url(), 'refresh');
}
}
// *************************END TEACHER SENT MESSAGE***************************//////
// *******************START RECIEVE MESSAGE*************************/

public function DeleteRecieve_message(){
if($this->session->userdata('user_id') != null) {
$userID = $this->session->userdata('user_id');
$userEmail = $this->session->userdata('email');
$msgID = $this->input->post('checkbox_value');

for ($i=0; $i<  count($msgID)  ; $i++) {
$this->TeacherMessage_model->DeleteRecieve_message($msgID[$i],$userEmail);
}

echo "<script>alert('Succesfully Deleted Recieve Message');</script>";
$this->Teacher_messageIndex();

} else {
redirect(base_url(), 'refresh');
}
}
public function PermanentDelMessage(){
if($this->session->userdata('user_id') != null) {
$userID = $this->session->userdata('user_id');
$msgID = $this->input->post('PermanentDel');
$this->TeacherMessage_model->DelRecieveMessage($msgID);
} else {
redirect(base_url(), 'refresh');
}
}
// *******************END RECIEVE MESSAGE*************************/
// **********************REPLY MESSAGE *************************/
public function Reply_Message(){
  $config = array(
          array(
                  'field' => 'relpy_message',
                  'label' => 'Message',
                  'rules' => 'required'
          ),

  );
  $this->form_validation->set_rules($config);
  if ($this->form_validation->run() == FALSE)
           {
              $this->Teacher_messageIndex();
           }
           else
           {
              $data = [
                    'message_id' => $this->input->post('message_id'),
                      'sender_id' => $this->session->userdata('user_id'),
                      'reciever_id' =>   $this->input->post('reciever_id'),
                      'description' =>  $this->input->post('relpy_message'),
                    'created_at' => date('Y-m-d H:i:s',now())
              ];
                  $this->TeacherMessage_model->DoReplyMessage($data);
           }
}

public function ReadMoreMessage(){
  if($this->session->userdata('user_id') != null) {
  $userEmail = $this->session->userdata('email');
  $messageId = $this->uri->segment(4);
  $data['GetSpecifiPost'] =  $this->TeacherMessage_model->ViewMore_model($messageId,$userEmail);
  $data['commentshow'] = $this->TeacherMessage_model->GetCommentPost($messageId);
  $data['title'] = "Teacher Message - NVAC Portal";
  $this->load->view('includes/_wrapper_start');
  $this->load->view('includes/_navbar');
  $this->load->view('includes/_aside');
  $this->load->view('Readmorepost', $data);
  $this->load->view('includes/_footer');
$this->load->view('includes/_wrapper_end');
} else {
      redirect(base_url(), 'refresh');
}
}
// ***********************END OF REPLY MESSAGE*************************/



public function Admin_messageIndex(){

      if($this->session->userdata('user_id') != null) {
        $aside = array(
            'menu'  => 'dashboardadmin',
            'submenu'     => 'message',
        );
        $this->session->set_flashdata($aside);
          $userEmail = $this->session->userdata('email');
          $userID = $this->session->userdata('user_id');
        $data['title'] = "Dashboard - NVAC Portal";
        $data['GetMessageRecieve'] = $this->AdminMessage_model->GetRecieveMessageAdmin($userEmail);
        $data['CountMessageNull'] = $this->AdminMessage_model->Count_all_messageisNULL();
        $data['CountMessageDelete'] = $this->AdminMessage_model->Count_allRemoveMessageRecieve();
        // $data['UserRole'] = $this->AdminMessage_model->getRoleUser();
              $data['CountMessageSent'] = $this->AdminMessage_model->CountSENTMESSAGE();
        $this->load->view('includes/_wrapper_start');
        $this->load->view('includes/_navbar');
        $this->load->view('includes/_aside');
        $this->load->view('Admin/AdminMessageIndex', $data);
        $this->load->view('includes/_footer');
    $this->load->view('includes/_wrapper_end');
      } else {
              redirect(base_url(), 'refresh');
      }
}

public function fetchOnAdmin()
{
$data = $this->input->post('query');
echo json_encode($this->AdminMessage_model->fetch_dataQ($data));
}

public function AdminSentMessage(){
  if($this->session->userdata('user_id') != null) {
          $userEmail = $this->session->userdata('email');
    $userID = $this->session->userdata('user_id');
    $data['title'] = "Dashboard - NVAC Portal";
    $data['GetSentMessage'] = $this->AdminMessage_model->FetchSentMessage($userEmail);
      $data['CountMessageNull'] = $this->AdminMessage_model->Count_all_messageisNULL();
    $data['CountMessageSent'] = $this->AdminMessage_model->CountSENTMESSAGE();
    $data['CountRemoveSent'] = $this->AdminMessage_model->CountRemoveMessage();
    $this->load->view('includes/_wrapper_start');
    $this->load->view('includes/_navbar');
    $this->load->view('includes/_aside');
    $this->load->view('Admin/SentMessageIndex', $data);
    $this->load->view('includes/_footer');
$this->load->view('includes/_wrapper_end');
  } else {
          redirect(base_url(), 'refresh');
  }
}
public function ListDeleteMessageInbox(){
  if($this->session->userdata('user_id') != null) {
      $userEmail = $this->session->userdata('email');
    $userID = $this->session->userdata('user_id');
    $data['title'] = "Dashboard - NVAC Portal";
        $data['CountMessageNull'] = $this->AdminMessage_model->Count_all_messageisNULL();
            $data['CountMessageSent'] = $this->AdminMessage_model->CountSENTMESSAGE();
    $data['GetDeleteInbox'] = $this->AdminMessage_model->FetchRemovemessage($userEmail);
    $this->load->view('includes/_wrapper_start');
    $this->load->view('includes/_navbar');
    $this->load->view('includes/_aside');
    $this->load->view('Admin/ListDeleteMessage', $data);
    $this->load->view('includes/_footer');
$this->load->view('includes/_wrapper_end');
  } else {
          redirect(base_url(), 'refresh');
  }
}
public function ListDeleteMessageSent(){
  if($this->session->userdata('user_id') != null) {
    $userEmail = $this->session->userdata('email');
    $userID = $this->session->userdata('user_id');
    $data['title'] = "Dashboard - NVAC Portal";
            $data['CountMessageNull'] = $this->AdminMessage_model->Count_all_messageisNULL();
                  $data['CountMessageSent'] = $this->AdminMessage_model->CountSENTMESSAGE();
    $data['GetSentDelete'] = $this->AdminMessage_model->FetchRemoveSentMessage($userEmail);
    $this->load->view('includes/_wrapper_start');
    $this->load->view('includes/_navbar');
    $this->load->view('includes/_aside');
    $this->load->view('Admin/DeleteSentList', $data);
    $this->load->view('includes/_footer');
$this->load->view('includes/_wrapper_end');
  } else {
          redirect(base_url(), 'refresh');
  }
}

public function DeleteMessageInbox(){
  if($this->session->userdata('user_id') != null) {
          $userEmail = $this->session->userdata('email');
$messageID  = $this->input->post('checkbox_value');
  $userID = $this->session->userdata('user_id');
for ($i=0; $i < count($messageID); $i++) {
  $this->AdminMessage_model->PermaDeleteRecieve($messageID[$i],$userEmail);
}
 $this->session->set_flashdata('msg',"Deleted Success");
        echo "<script>alert('Deleted Success');</script>";

} else {
      redirect(base_url(), 'refresh');
}
}

public function AdminDeleteSentMessage(){
  if($this->session->userdata('user_id') != null) {
              $userEmail = $this->session->userdata('email');
$messageID  = $this->input->post('checkbox_value');
  $userID = $this->session->userdata('user_id');
for ($i=0; $i < count($messageID); $i++) {
  $this->AdminMessage_model->RemoveSentMessage($messageID[$i],$userEmail);
}
 $this->session->set_flashdata('msg',"Deleted Success");
        echo "<script>alert('Deleted Success');</script>";

} else {
      redirect(base_url(), 'refresh');
}
}



public function DeleteSentMessagelist(){
  if($this->session->userdata('user_id') != null) {
        $userEmail = $this->session->userdata('email');
$messageID  = $this->input->post('checkbox_value');
  $userID = $this->session->userdata('user_id');
for ($i=0; $i < count($messageID); $i++) {
  $this->AdminMessage_model->PermaDeleteSent($messageID[$i],$userEmail);
}
 $this->session->set_flashdata('msg',"Deleted Success");
        echo "<script>alert('Deleted Success');</script>";

} else {
      redirect(base_url(), 'refresh');
}
}
public function GetRoleUser(){
$roleUserCateg = array();
$roleCategoryID =  $this->input->post('roleCategoryID');
if($roleCategoryID){
$con['conditions'] = array('roleCategoryID'=>$roleCategoryID);
$roleUserCateg = $this->AdminMessage_model->GetRoleUserCateg($con);
}
echo json_encode($roleUserCateg);
}

public function SendMessageAdmin(){
if($this->session->userdata('user_id') != null) {

$config = array(
        array(
                'field' => 'titleDescrition',
                'label' => 'Title Description',
                'rules' => 'required'
        ),
        array(
                'field' => 'messageDescription',
                'label' => 'Message Description',
                'rules' => 'required',

        ),

);
$this->form_validation->set_rules($config);
if ($this->form_validation->run() == FALSE)
         {
            $this->Admin_messageIndex();
         }
         else
         {


                            $inputdata  = $this->input->post('sendto');
                            if(! empty($inputdata)){
                            foreach ($inputdata as $key => $value) {
                            $valueofdata  = strval($value);
                            }
                            $explode = explode(",",$valueofdata);
                            // $stringdata = preg_replace('/\s+/', '', $explode);

                            for ($i=0; $i < count($explode); $i++) {
                            $data = [
                              'sender_email' => $this->session->userdata('email'),
                              'reciever_email'=> $explode[$i],
                            'title' =>  $this->input->post('titleDescrition'),
                            'description' => $this->input->post('messageDescription'),
                           'created_at' => date('Y-m-d H:i:s',now())
                            ];
                                  $this->AdminMessage_model->InsertMessage($data);
                            }
                            }

         }


} else {
  redirect(base_url(), 'refresh');
}
}


// **************************END OF ADMIN MESSAGE******************************/






}
