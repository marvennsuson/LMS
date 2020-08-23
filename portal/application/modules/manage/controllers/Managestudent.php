<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Managestudent extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Managestudent_teacher');
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
                  $this->manageStudent();
              }elseif($this->session->role_id == 4)
              {

              }else
              {

              }
              } else {
                      redirect(base_url(), 'refresh');
              }
  }

  public function manageStudent(){
        if($this->session->userdata('user_id') != null) {
          $aside = array(
              'menu'  => 'manage_student',
              'submenu'     => 'add',
          );
          $this->session->set_flashdata($aside);
          $data['title'] = "Dashboard - NVAC Portal";
          $userID = $this->session->userdata('user_id');
          $data['GetStudent'] = $this->Managestudent_teacher->GetStudent();
          $data['getSubjectCode'] = $this->Managestudent_teacher->GetSubjectByteacher($userID);
          $this->load->view('includes/_wrapper_start');
          $this->load->view('includes/_navbar');
          $this->load->view('includes/_aside');
          $this->load->view('ManageIndex', $data);
          $this->load->view('includes/_footer');
      $this->load->view('includes/_wrapper_end');


        } else {
                redirect(base_url(), 'refresh');
        }

  }

  public function RegisterStudent(){
            if($this->session->userdata('user_id') != null) {
            $userID = $this->session->userdata('user_id');
              $StudID = $this->input->post("CheckId");
                      $subjcodeID = $this->input->post("SubjectCodeID");

                $SubData  =  $this->Managestudent_teacher->GetBysubCode($subjcodeID);

                  foreach ($SubData->result() as $SubData_row) {
                      $SubjCodedb = $SubData_row->subjectcode;
                      $clascodedb = $SubData_row->classcode;
                      $SubNamedb = $SubData_row->subject_name;
                      $SectionDb =  $SubData_row->section;
                                  $schedb =  $SubData_row->schedule;
                                              $advtechdb =  $SubData_row->adviser_teacher;
                                                          $subDescdb =  $SubData_row->subject_description;
                  }

              for ($i=0; $i < count($StudID); $i++) {
                $data = [
                    'subjectcode' => $SubjCodedb,
                      'classcode' => $clascodedb,
                      'subject_name' => $SubNamedb,
                      'teacher_code' => $userID,
                      'section' => $SectionDb,
                      'schedule' => $schedb,
                      'adviser_teacher' => $advtechdb,
                      'student_id' => $StudID[$i],
                      'subject_description' => $subDescdb,
                        'created_at' => date('Y-m-d H:i:s',now())
                ];
                  $this->Managestudent_teacher->RegisterStudent_model($data);
              }


  } else {
          redirect(base_url(), 'refresh');
  }
  }

}
