<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profiles extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
      $this->load->model('Profile_model');
      $this->load->helper('date');
      $this->load->database();
      $this->load->model('TeacherProfile_model');
  }

  function index()
  {
    if($this->session->userdata('user_id') != null) {
          if($this->session->role_id == 1){

          }elseif($this->session->role_id == 2){

          }elseif($this->session->role_id == 3){
            $this->TeacherProfile_index();
          }elseif($this->session->role_id == 4){
              $this->StudentProfile();
          }else{

          }
} else {
        redirect(base_url(), 'refresh');
}

  }


  public function TeacherProfile_index(){
    if($this->session->userdata('user_id') != null) {
        // redirect(base_url('dashboard'), 'refresh');

        $aside = array(
            'menu'  => 'dashboardteacher',
            'submenu'     => 'profile',
        );
        $this->session->set_flashdata($aside);





            $data = array();
            $config['next_link']        = 'Next';
            $config['prev_link']        = 'Prev';
            $config['first_link']       = false;
            $config['last_link']        = false;
            $config['full_tag_open']    = '<ul class="pagination justify-content-center">';
            $config['full_tag_close']   = '</ul>';
            $config['attributes']       = ['class' => 'page-link'];
            $config['first_tag_open']   = '<li class="page-item">';
            $config['first_tag_close']  = '</li>';
            $config['prev_tag_open']    = '<li class="page-item">';
            $config['prev_tag_close']   = '</li>';
            $config['next_tag_open']    = '<li class="page-item">';
            $config['next_tag_close']   = '</li>';
            $config['last_tag_open']    = '<li class="page-item">';
            $config['last_tag_close']   = '</li>';
            $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
            $config['num_tag_open']     = '<li class="page-item">';
            $config['num_tag_close']    = '</li>';
            $config['per_page'] = 10;
            $config['base_url'] = base_url('/profile/Profiles/TeacherProfile_index/');
            $config['total_rows'] = $this->TeacherProfile_model->get_countTimelinePost();
            $this->pagination->initialize($config);
            $page = ( $this->uri->segment(4) ) ? $this->uri->segment(4) : 0;
            $data['getallpost'] = $this->TeacherProfile_model->GetAllTimelinePost($config['per_page'], $page);
            $data['pagination1'] = $this->pagination->create_links();



        $userID = $this->session->userdata('user_id');
      $data['GetInfo']  = $this->TeacherProfile_model->GetInformation($userID);
      $data['subjectlist'] = $this->TeacherProfile_model->GetClass();
        $data['title'] = "Profile - NVAC Portal";
        $this->load->view('includes/_wrapper_start');
        $this->load->view('includes/_navbar');
        $this->load->view('includes/_aside');
        $this->load->view('Teacher_profile', $data);
        $this->load->view('includes/_footer');
    $this->load->view('includes/_wrapper_end');
} else {
        redirect(base_url(), 'refresh');
}
  }

public function getListRegister(){
$data['Studentlist'] = $this->TeacherProfile_model->getResiter(trim($this->input->post('subcode')));
$this->load->view('ClassList',$data);
}


  public function Changepassword_teacher(){
    if($this->session->userdata('user_id') != null) {
  $userID = $this->session->userdata('user_id');
  $config = array(
      array(
              'field' => 'newpass',
              'label' => 'New Password',
              'rules' => 'required'
      ),
      // array(
      //         'field' => 'oldpass',
      //         'label' => 'Old Password',
      //         'rules' => 'required'
      // ),

  );
  $this->form_validation->set_rules($config);
  if ($this->form_validation->run() == FALSE)
       {
          $this->TeacherProfile_index();
       }
       else
       {
      $data = [
          'password' => md5(trim($this->input->post('newpass'))),
          'updated_at' => date('Y-m-d H:i:s',now())
      ];
      $this->TeacherProfile_model->UpdatePassword($data,$userID);
      json_encode($data);
       }
     } else {
             redirect(base_url(), 'refresh');
     }
  }


  public function UpdateTeacherProfile(){
    if($this->session->userdata('user_id') != null) {
  $userID = $this->session->userdata('user_id');
  $config = array(
      array(
              'field' => 'name',
              'label' => 'FullName',
              'rules' => 'required'
      ),
      array(
              'field' => 'email',
              'label' => 'Email',
              'rules' => 'required'
      ),
      array(
              'field' => 'address',
              'label' => 'Address Details',
              'rules' => 'required'
      ),
      array(
              'field' => 'mobile',
              'label' => 'Mobile Number',
              'rules' => 'required'
      ),
      // array(
      //         'field' => 'oldpass',
      //         'label' => 'Old Password',
      //         'rules' => 'required'
      // ),

  );
  $this->form_validation->set_rules($config);
  if ($this->form_validation->run() == FALSE)
       {
          $this->TeacherProfile_index();
       }
       else
       {
      $data = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
            'mobile' => $this->input->post('mobile'),
          'updated_at' => date('Y-m-d H:i:s',now())
      ];
      $this->TeacherProfile_model->UpdateProfile($data,$userID);
      json_encode($data);
       }
     } else {
             redirect(base_url(), 'refresh');
     }

  }

// Student start

    public function StudentProfile(){
      if($this->session->userdata('user_id') != null) {
          // redirect(base_url('dashboard'), 'refresh');
          $aside = array(
              'menu'  => 'dashboardStudent',
              'submenu'     => 'profile',
          );
          $this->session->set_flashdata($aside);


          $userID = $this->session->userdata('user_id');

          $data['title'] = "Profile - NVAC Portal";

          $data['Schedule'] = $this->Profile_model->getScheduleStudent($userID);
          $data['profilers'] =   $this->Profile_model->GetStudentProfilemodel($userID);
          $this->load->view('includes/_wrapper_start');
          $this->load->view('includes/_navbar');
          $this->load->view('includes/_aside');
          $this->load->view('Student_profile', $data);
          $this->load->view('includes/_footer');
      $this->load->view('includes/_wrapper_end');
  } else {
          redirect(base_url(), 'refresh');
  }
    }

public function UpdateStudentProfile(){
        if($this->session->userdata('user_id') != null) {
    $userID = $this->session->userdata('user_id');
  $config = array(
          array(
                  'field' => 'email',
                  'label' => 'Email',
                  'rules' => 'required'
          ),
          array(
                  'field' => 'mobileno',
                  'label' => 'mobile Number',
                  'rules' => 'required',

          ),
          array(
                  'field' => 'address',
                  'label' => 'Student Address',
                  'rules' => 'required'
          ),
          array(
                  'field' => 'guardian_name',
                  'label' => 'Guardian Name',
                  'rules' => 'required'
          ),
          array(
                  'field' => 'guardian_mobile',
                  'label' => 'Mobile Number',
                  'rules' => 'required'
          ),
          array(
                  'field' => 'guardian_address',
                  'label' => 'Guardian Address',
                  'rules' => 'required'
          ),


  );
  $this->form_validation->set_rules($config);
  if ($this->form_validation->run() == FALSE)
           {
              $this->StudentProfile();
           }
           else
           {
              $studID  =   $this->input->post('base_id');
              $data = [
                      'email ' => $this->input->post('email'),
                    'cellphone' => $this->input->post('mobileno'),
                    'address' => $this->input->post('address'),
                      'guardian_name' => $this->input->post('guardian_name'),
                      'guardian_mobile' => $this->input->post('guardian_mobile'),
                      'guardian_address' => $this->input->post('guardian_address'),
                    'updated_at ' => date('Y-m-d H:i:s',now())
              ];
                  $this->Profile_model->UpdateProfileStudent($data,$studID);
                  echo "<script>alert('Successfully Added');</script>";
                    $this->StudentProfile();

           }
         } else {
                 redirect(base_url(), 'refresh');
         }

}

public function Changepassword(){
  if($this->session->userdata('user_id') != null) {
$userID = $this->session->userdata('user_id');
$config = array(
    array(
            'field' => 'newpass',
            'label' => 'New Password',
            'rules' => 'required'
    ),
    // array(
    //         'field' => 'oldpass',
    //         'label' => 'Old Password',
    //         'rules' => 'required'
    // ),

);
$this->form_validation->set_rules($config);
if ($this->form_validation->run() == FALSE)
     {
        $this->StudentProfile();
     }
     else
     {
    // $get =   $this->Profile_model->valitadorPassword($userID);
    // if($get->num_rows() > 0){
    //   foreach ($get->result() as $value_row) {
    //       $dbpass = $value_row->password;
    //   }
    // }
    // $oldpass = $this->input->post('oldpass');
    //   if($oldpass === $dbpass){
    //   }else{
    //       $data['message'] = "Old password Not Found";
    //
    //   }
                $data = [
                    'password' => md5(trim($this->input->post('newpass'))),
                    'updated_at' => date('Y-m-d H:i:s',now())
                ];
                $this->Profile_model->UpdatePassword($data,$userID);
                json_encode($data);


     }
   } else {
           redirect(base_url(), 'refresh');
   }
}

// STUDENT END
}
