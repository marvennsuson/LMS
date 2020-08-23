<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher_controller extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
        $this->load->helper('date');
        $this->load->model('Teacher_model');
  }

  function index()
  {
    if($this->session->userdata('user_id') != null) {
        // redirect(base_url('dashboard'), 'refresh');
        $aside = array(
            'menu'  => 'createAccount',
            'submenu'     => 'registrationteacher',
        );
        $this->session->set_flashdata($aside);
        $data['title'] = "Dashboard - NVAC Portal";
        $data['teacherlist'] = $this->Teacher_model->GetTeacherList();
        $this->load->view('includes/_wrapper_start');
        $this->load->view('includes/_navbar');
        $this->load->view('includes/_aside');
        $this->load->view('teacher/TeacherIndex', $data);
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
  $id = $this->Teacher_model->FetchTeacherInfo($explode[$i]);
foreach ($id as $key => $value) {
  $pass = $this->generate_string(10);
  $email = $value["email"];
    $data = [
        'user_id' => $value["staffcode"],
        'email' => $value["email"],
        'password' => $pass,
        'role' => '3',
          'created_at' => date('Y-m-d H:i:s',now())

    ];

    $this->Mailer($email,$pass,$data);
}
  $this->Teacher_model->updateStatusTeacher($explode[$i]);
}

  } else {
          redirect(base_url(), 'refresh');
  }
  }


public function Mailer($email,$pass,$data){
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
  $mail->addAddress($email); //email address of recipient
  $mail->Subject = 'User Login Account for NVAC School';
  //If sending HTML email set to true else set to false
  $mail->isHTML(true);
  // Email body content
  $mailContent = "<h1>Your User login Account For NVAC PORTAL</h1>
  <p> Your username :$email And Password : $pass </p>";
  $mail->Body = $mailContent;

  // Send email
  if(!$mail->send()){
  echo 'Message could not be sent.';
  echo 'Mailer Error: ' . $mail->ErrorInfo;
  }else{
  $this->Teacher_model->insertCredentialsTeacher($data);
  }
  } catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}






}
