<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Virtuallesson_controller extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Virtuallesson_model');
        $this->load->helper('date');
  }

  function index()
  {

    if($this->session->userdata('user_id') != null) {
              if($this->session->role_id == 1)
              {

              }elseif($this->session->role_id == 2)
              {

              }elseif($this->session->role_id == 3)
              {
                  $this->TeacherlessonIndex();
              }elseif($this->session->role_id == 4)
              {

              }else
              {

              }
} else {
        redirect(base_url(), 'refresh');
}

  }

    public function TeacherlessonIndex(){

          if($this->session->userdata('user_id') != null) {
              // redirect(base_url('elearning'), 'refresh');
              $aside = array(
                  'menu'  => 'activities',
                  'submenu'     => 'video_lesson',
              );
              $this->session->set_flashdata($aside);
            $data['title'] = "E-learning - NVAC Portal";
            $data['VideoLinklist'] = $this->Virtuallesson_model->GetVideoLinkList();
            $data['subjectlist'] = $this->Virtuallesson_model->GetSubject();
              $this->load->view('includes/_wrapper_start');
              $this->load->view('includes/_navbar');
              $this->load->view('includes/_aside');
              $this->load->view('VirtualLesson/VirtuallessonIndex', $data);
              $this->load->view('includes/_footer');
          $this->load->view('includes/_wrapper_end');
      } else {
              redirect(base_url(), 'refresh');
      }

    }

    public function GetspecificPlaylist(){
    $data['showEdit'] = $this->Virtuallesson_model->GetSpecificVideo(trim($this->input->post('videoID')));
    $this->load->view('VirtualLesson/Modalviewer/LessonUpdate',$data);
    }

    public function Removelesson(){
      if($this->session->userdata('user_id') != null) {
        $teachId = $this->session->userdata('user_id');
        $lessonID = $this->input->post('checkbox_value');

            for ($i=0; $i < count($lessonID) ; $i++) {
            $this->Virtuallesson_model->Deletelesson($lessonID[$i],$teachId);
            }

} else {
        redirect(base_url(), 'refresh');
}

    }

  public function ComposingLesson(){
    if($this->session->userdata('user_id') != null) {
    $config = array(
            array(
                    'field' => 'lessonnum',
                    'label' => 'Lesson Number',
                    'rules' => 'required'
            ),
            array(
                    'field' => 'lessontopic',
                    'label' => 'Lesson Topic',
                    'rules' => 'required',

            ),
            array(
                    'field' => 'lessoninstruction',
                    'label' => 'Lesson Instrution',
                    'rules' => 'required',

            ),
            array(
                    'field' => 'ytlink',
                    'label' => 'Youtube link',
                    'rules' => 'required',

            ),

    );
    $this->form_validation->set_rules($config);
    if ($this->form_validation->run() == FALSE)
             {
                $this->TeacherlessonIndex();
             }
             else
             {
                $String = "https://www.youtube.com/embed/";
                $ytLink = $this->input->post('ytlink');
                $data_val = $String.$ytLink;
                $subject = $this->input->post('subjectname');

                for ($i=0; $i < count($subject) ; $i++) {
                  $data =[
                      'Teacher_id' => $this->session->userdata('user_id'),
                      'Subject_code' => $subject[$i],
                      'lesson_number' => $this->input->post('lessonnum'),
                      'lesson_topic' => $this->input->post('lessontopic'),
                      'lesson_instruct' => $this->input->post('lessoninstruction'),
                      'youtube_link' => $data_val,
                        'created_at' => date('Y-m-d H:i:s',now())
                  ];
                  $this->Virtuallesson_model->InsertLesson($data);
                }


             }


    } else {
      redirect(base_url(), 'refresh');
    }
  }


  public function UpdateLesson(){
    if($this->session->userdata('user_id') != null) {
    $config = array(
            array(
                    'field' => 'lessonnumUpdate',
                    'label' => 'Lesson Number',
                    'rules' => 'required'
            ),
            array(
                    'field' => 'lessontopicUpdate',
                    'label' => 'Lesson Topic',
                    'rules' => 'required',

            ),
            array(
                    'field' => 'lessonInstUpdate',
                    'label' => 'Lesson Instrution',
                    'rules' => 'required',

            ),
            array(
                    'field' => 'ytlinkupdate',
                    'label' => 'Youtube link',
                    'rules' => 'required',

            ),

    );
    $this->form_validation->set_rules($config);
    if ($this->form_validation->run() == FALSE)
             {
                $this->TeacherlessonIndex();
             }
             else
             {
                $String = "https://www.youtube.com/embed/";
                $ytLink = $this->input->post('ytlinkupdate');
                $data_val = $String.$ytLink;
                $subject = $this->input->post('SubjectCode');
                  $id = $this->input->post('RowID');

                  $data =[
                      'lesson_number' => $this->input->post('lessonnumUpdate'),
                      'lesson_topic' => $this->input->post('lessontopicUpdate'),
                      'lesson_instruct' => $this->input->post('lessonInstUpdate'),
                      'youtube_link' => $data_val,
                        'update_at' => date('Y-m-d H:i:s',now())
                  ];


                  $this->Virtuallesson_model->UpdateData($data,$subject,$id);



             }


    } else {
      redirect(base_url(), 'refresh');
    }
  }

}
