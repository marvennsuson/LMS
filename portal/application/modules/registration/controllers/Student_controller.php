<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Student_controller extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Student_model');
    $this->load->database();
        $this->load->helper('date');
        // $this->load->library('PHPMailer_lib');
  }




  function index()
  {
    if($this->session->userdata('user_id') != null) {
        // redirect(base_url('dashboard'), 'refresh');
        $aside = array(
            'menu'  => 'createAccount',
            'submenu'     => 'registrationstudent',
        );
        $this->session->set_flashdata($aside);
        $data['title'] = "Dashboard - NVAC Portal";
        $data['studentNologin'] = $this->Student_model->GetStudentNoLogin();
        $this->load->view('includes/_wrapper_start');
        $this->load->view('includes/_navbar');
        $this->load->view('includes/_aside');
        $this->load->view('student/StudentIndex', $data);
        $this->load->view('includes/_footer');
    $this->load->view('includes/_wrapper_end');
}else{
        redirect(base_url(), 'refresh');
}
  }


  function generate_string($strength = 16) {
      $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $input_length = strlen($permitted_chars);
      $random_string = '';
      for($i = 0; $i < $strength; $i++) {
          $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
          $random_string .= $random_character;
      }

      return $random_string;
  }

public function Configuringdata(){
if($this->session->userdata('user_id') != null) {
$teachId = $this->session->userdata('user_id');

$StudID = $this->input->post('checkbox_value');
// $StudID = $this->input->post('studNumber');
$lals = implode(',',$StudID);
$explode = explode(",",$lals);

for ($i=0; $i <  count($explode); $i++) {
$id = $this->Student_model->FetchStudentInfo($explode[$i]);
$this->Student_model->updateStatus($explode[$i]);
$this->Student_model->updateGuardianStatus($explode[$i]);
foreach ($id as $key => $value) {
$studpassword = $this->generate_string(10);
$studEmail = $value["email"];
$data = [
'user_id' => $value["student_number"],
'email' => $value["email"],
'	password' => $studpassword,
'role' => '4',
'created_at' => date('Y-m-d H:i:s',now())

];

try {
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = "marvennkhulets@gmail.com";//enter your gmail address
$mail->Password = "Mkhulets09"; //password of your gmail account
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->setFrom('Nvac@example.com', 'Naga View Adventist College');
$mail->addReplyTo('Nvac@example.com', 'Naga View Adventist College');
$mail->addAddress($studEmail); //email address of recipient
$mail->Subject = 'User Login Account for NVAC School';
//If sending HTML email set to true else set to false
$mail->isHTML(true);
// Email body content
$mailContent = "<h1>Your User login Account For NVAC PORTAL</h1>
<p> Your username :$studEmail And Password : $studpassword </p>";
$mail->Body = $mailContent;

// Send email
if(!$mail->send()){
echo 'Message could not be sent.';
echo 'Mailer Error: ' . $mail->ErrorInfo;
}else{

  $this->Student_model->insertCredentials($data);
}
} catch (Exception $e) {
echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}
foreach ($id as $key => $value) {
 $password =  $this->generate_string(10);
 $guardianemail = $value["guardian_email"];
$data = [
'user_id' => $value["id"],
'email' => $value["guardian_email"],
'password' => $password,
'role' => '5',
'created_at' => date('Y-m-d H:i:s',now())

];

try {
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = "marvennkhulets@gmail.com";//enter your gmail address
$mail->Password = "Mkhulets09"; //password of your gmail account
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->setFrom('Nvac@example.com', 'Naga View Adventist College');
$mail->addReplyTo('Nvac@example.com', 'Naga View Adventist College');
$mail->addAddress($guardianemail); //email address of recipient
$mail->Subject = 'User Login Account for NVAC School';
//If sending HTML email set to true else set to false
$mail->isHTML(true);
// Email body content
$mailContent = "<h1>Your User login Account For NVAC PORTAL</h1>
<p> Your username :$guardianemail And Password : $password </p>";
$mail->Body = $mailContent;

// Send email
if(!$mail->send()){
echo 'Message could not be sent.';
echo 'Mailer Error: ' . $mail->ErrorInfo;
}else{
$this->Student_model->insertCredentials($data);
}
} catch (Exception $e) {
echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


}

}
} else {
redirect(base_url(), 'refresh');
}
}




}
