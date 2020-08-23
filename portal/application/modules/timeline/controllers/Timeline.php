<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timeline extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->helper('date');
    $this->load->model('Teachertimeline_model');
    $this->load->model('Studenttimeline_model');
    $this->load->library('upload');
    $this->load->model("Admintimeline_model");
  }

  function index()
  {
    if($this->session->userdata('user_id') != null) {
              if($this->session->role_id == 1)
              {

              }elseif($this->session->role_id == 2)
              {
                $this->AdminIndextimeline();

              }elseif($this->session->role_id == 3)
              {
                  $this->TeacherIndextimeline();
              }elseif($this->session->role_id == 4)
              {
                  $this->Student_timeline();
              }else
              {

              }
              }
              else
              {
                      redirect(base_url(), 'refresh');
              }
  }

public function TeacherIndextimeline(){
if($this->session->userdata('user_id') != null) {
    // redirect(base_url('dashboard'), 'refresh');
    // $userID = $this->session->userdata('user_id');

    $aside = array(
        'menu'  => 'dashboardteacher',
        'submenu'     => 'timeline',
    );
    $this->session->set_flashdata($aside);



    $data = array();
    $userID  = $this->session->userdata('user_id');
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
    $config['base_url'] = base_url('/timeline/Timeline/TeacherIndextimeline/');
    $config['total_rows'] = $this->Teachertimeline_model->get_countTimelinePost();
    $this->pagination->initialize($config);
    $page = ( $this->uri->segment(4) ) ? $this->uri->segment(4) : 0;
    $data['getallpost'] = $this->Teachertimeline_model->GetAllTimelinePost($config['per_page'], $page);
    $data['pagination1'] = $this->pagination->create_links();

    $data['title'] = "timeline - NVAC Portal";
    // $data['GetComment'] = $this->Teachertimeline_model->GetcommentPost();
    // $data['getpost'] = $this->Teachertimeline_model->GetMyTimelinePost($userID);
    // $data['getallpost'] = $this->Teachertimeline_model->GetAllTimelinePost();
    $data['GetTeacher'] = $this->Teachertimeline_model->GetAllTeacher();
    $data['subjectcode'] = $this->Teachertimeline_model->GetSubject_teacher();
    $this->load->view('includes/_wrapper_start');
    $this->load->view('includes/_navbar');
    $this->load->view('includes/_aside');
    $this->load->view('Teacher_timeline', $data);
    $this->load->view('includes/_footer');
    $this->load->view('includes/_wrapper_end');
  } else {
          redirect(base_url(), 'refresh');
  }
}
public function timelinebroadcastData(){
  $config = array(
          array(
                  'field' => 'timelinetitle',
                  'label' => 'Title',
                  'rules' => 'required|min_length[10]'
          ),
          array(
                  'field' => 'timelinedesc',
                  'label' => 'Description',
                  'rules' => 'required|min_length[10]',

          ),
  );
  $this->form_validation->set_rules($config);
  if ($this->form_validation->run() == FALSE)
           {
             $this->TeacherIndextimeline();
           }
           else
           {

        $teacher_id   =   $this->input->post('All_techer');
    $subjectCode =  $this->input->post('subjectid');
            if(! empty($teacher_id)){
              for ($i=0; $i  <  count($teacher_id); $i++) {
                  $data = [
                        'user_id' => $this->session->userdata('user_id'),
                          // 'subject_code ' => $this->input->post('subjectid'),
                          'reciever_id' => $teacher_id[$i],
                        'title' => $this->input->post('timelinetitle'),
                        'description' => $this->input->post('timelinedesc'),
                        'created_at' => date('Y-m-d H:i:s',now())
                  ];

                      $this->Teachertimeline_model->InsertTimeline($data);
                    }

            }elseif(! empty($subjectCode)){
              $data = [
                    'user_id' => $this->session->userdata('user_id'),
                      'subject_code ' => $this->input->post('subjectid'),
                      // 'reciever_id' => $teacher_id[$i],
                    'title' => $this->input->post('timelinetitle'),
                    'description' => $this->input->post('timelinedesc'),
                    'created_at' => date('Y-m-d H:i:s',now())
              ];

                  $this->Teachertimeline_model->InsertTimeline($data);
            }else{

            }

           }
}
public function DeletedTeacherTimeline(){
  if($this->session->userdata('user_id') != null) {
      // redirect(base_url('dashboard'), 'refresh');
      $userID = $this->session->userdata('user_id');
        $TimelineID = $this->uri->segment(4);
            $this->Teachertimeline_model->DeleteTimelinepost($TimelineID,$userID);
            $data['title'] = "timeline - NVAC Portal";
            // $data['GetComment'] = $this->Teachertimeline_model->GetcommentPost();
            $data['getpost'] = $this->Teachertimeline_model->GetMyTimelinePost($userID);
            $data['getallpost'] = $this->Teachertimeline_model->GetAllTimelinePost();
            $data['subjectcode'] = $this->Teachertimeline_model->GetSubject_teacher();
            $this->load->view('includes/_wrapper_start');
            $this->load->view('includes/_navbar');
            $this->load->view('includes/_aside');
            $this->load->view('Teacher_timeline', $data);
            $this->load->view('includes/_footer');
            $this->load->view('includes/_wrapper_end');
    } else {
            redirect(base_url(), 'refresh');
    }
}

/*********START OF STUDENT TIME LINE************/
public function Student_timeline(){

if($this->session->userdata('user_id') != null) {

        $aside = array(
            'menu'  => 'dashboardStudent',
            'submenu'     => 'timeline',
        );
        $this->session->set_flashdata($aside);

        // $data['GetmyTeacherPost'] = $this->Studenttimeline_model->GetPostTeacher();
// redirect(base_url('dashboard'), 'refresh');
$userID = $this->session->userdata('user_id');
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

$config['base_url'] = base_url('/timeline/Timeline/Student_timeline/');
$config['total_rows'] = $this->Studenttimeline_model->GetCountTimeline();
$this->pagination->initialize($config);
$page = ( $this->uri->segment(4) ) ? $this->uri->segment(4) : 0;
$data['GetmyTeacherPost'] = $this->Studenttimeline_model->GetPostTeacher($config['per_page'], $page);
$data['links'] = $this->pagination->create_links();
$data['title'] = "timeline - NVAC Portal";
$this->load->view('includes/_wrapper_start');
$this->load->view('includes/_navbar');
$this->load->view('includes/_aside');
$this->load->view('Student_timeline', $data);
$this->load->view('includes/_footer');
$this->load->view('includes/_wrapper_end');
} else {
      redirect(base_url(), 'refresh');
}
}
public function GetSpecificPost(){
if($this->session->userdata('user_id') != null) {
// redirect(base_url('dashboard'), 'refresh');
$userID = $this->session->userdata('user_id');
$TimelineID = $this->uri->segment(4);
$data['commentshow'] = $this->Studenttimeline_model->GetCommentPost($TimelineID);
$data['GetSpecifiPost'] = $this->Studenttimeline_model->GetSpecifiPost($TimelineID);
$data['title'] = "timeline - NVAC Portal";
$this->load->view('includes/_wrapper_start');
$this->load->view('includes/_navbar');
$this->load->view('includes/_aside');
$this->load->view('Timelineview_post', $data);
$this->load->view('includes/_footer');
$this->load->view('includes/_wrapper_end');
} else {
      redirect(base_url(), 'refresh');
}
}
public function CreateComment(){

$config = array(
    array(
            'field' => 'user_comment',
            'label' => 'Comment',
            'rules' => 'required'
    )

);
$this->form_validation->set_rules($config);
if ($this->form_validation->run() == FALSE)
     {

          if($this->session->role_id == 3){
              $this->TeacherIndextimeline();
          }elseif($this->session->role_id == 4){
              $this->Student_timeline();
          }else{
              $this->AdminIndextimeline();
          }
     }
     else
     {
       $data = [
          'user_id' =>  $this->session->userdata('user_id'),
          'timeline_id' => $this->input->post('timelineid'),
          'description' => $this->input->post('user_comment'),
            'created_at' => date('Y-m-d H:i:s',now())
       ];
    $Continue   = $this->Studenttimeline_model->AddCommentPost($data);
     }
}
  /***END OF STUDENT TIMELINE***/



  // *******************START OF ADMIN****************************/
  public function AdminIndextimeline(){
        if($this->session->userdata('user_id') != null) {

              $aside = array(
                  'menu'  => 'dashboardadmin',
                  'submenu'     => 'timeline',
              );
              $this->session->set_flashdata($aside);


              $data = array();
              $userID  = $this->session->userdata('user_id');
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
              $config['base_url'] = base_url('/timeline/Timeline/TeacherIndextimeline/');
              $config['total_rows'] = $this->Admintimeline_model->get_countTimelinePost();
              $this->pagination->initialize($config);
              $page = ( $this->uri->segment(4) ) ? $this->uri->segment(4) : 0;
              $data['getallpost'] = $this->Admintimeline_model->GetAllTimelinePost($config['per_page'], $page);
              $data['paginationadmin'] = $this->pagination->create_links();


          $userID = $this->session->userdata('user_id');
          $data['title'] = "Dashboard - NVAC Portal";
          $data['UserRole'] = $this->Admintimeline_model->GetRoleCateg();
          // $data['getallpost'] = $this->Admintimeline_model->GetAllTimelinePost();
          $this->load->view('includes/_wrapper_start');
          $this->load->view('includes/_navbar');
          $this->load->view('includes/_aside');
          $this->load->view('AdminTimelineIndex', $data);
          $this->load->view('includes/_footer');
      $this->load->view('includes/_wrapper_end');

        }else
        {
                redirect(base_url(), 'refresh');
        }
  }

  public function GetRoleUser(){
  $roleUserCateg = array();
  $roleCategoryID =  $this->input->post('roleCategoryID');
  if($roleCategoryID){
  $con['conditions'] = array('roleCategoryID'=>$roleCategoryID);
  $roleUserCateg = $this->Admintimeline_model->GetRoleUserCateg($con);
  }
  echo json_encode($roleUserCateg);
  }
    public function PostTimelineAdmin(){
      $config = array(
              array(
                      'field' => 'timelinetitle',
                      'label' => 'Title',
                      'rules' => 'required|min_length[10]'
              ),
              array(
                      'field' => 'timelinedesc',
                      'label' => 'Description',
                      'rules' => 'required|min_length[10]',

              ),

      );
      $this->form_validation->set_rules($config);
      if ($this->form_validation->run() == FALSE)
               {
            $this->AdminIndextimeline();
               }
               else
               {

            $userID   =   $this->input->post('ByRole');
              for ($i=0; $i  <  count($userID); $i++) {
                  $data = [
                        'user_id' => $this->session->userdata('user_id'),
                          'reciever_id' => $userID[$i],
                        'title' => $this->input->post('timelinetitle'),
                        'description' => $this->input->post('timelinedesc'),
                        'created_at' => date('Y-m-d H:i:s',now())
                  ];

                      $this->Admintimeline_model->InsertTimeline($data);
                    }
                      echo "<script>alert('Successfully Added');</script>";
                            redirect(base_url(), 'refresh');

               }
    }
  // *************************************************/

}
