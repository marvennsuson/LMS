<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CLassStudent extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('ClassStudent_model');
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
                  $this->ClassManageStudent();
              }elseif($this->session->role_id == 4)
              {

              }else
              {

              }
              } else {
                      redirect(base_url(), 'refresh');
              }
  }

  public function ClassManageStudent(){
        if($this->session->userdata('user_id') != null) {

          $aside = array(
              'menu'  => 'manage_student',
              'submenu'     => 'drop',
          );
          $this->session->set_flashdata($aside);


          $userID = $this->session->userdata('user_id');
        //     $row_val = $this->ClassStudent_model->GetClass($userID);
        // if($row_val->num_rows() > 0){
        //   foreach ($row_val->result() as $key => $value_row) {
        //   $classID =  $value_row->blockclassid;
        //    $gerow = array();
        //   if($classID){
        //     $con['conditions'] = array('classID'=>$classID);
        //     $gerow = $this->ClassStudent_model->GetSubject($con,$userID);
        //   }
        //
        //    }
        // }


          $data['title'] = "Dashboard - NVAC Portal";
          $data['GetClass'] = $this->ClassStudent_model->getSubcode($userID);
          // $data['GetStudent'] = $this->ClassStudent_model->GetStudent($userID);

          $this->load->view('includes/_wrapper_start');
          $this->load->view('includes/_navbar');
          $this->load->view('includes/_aside');
          $this->load->view('Class_index', $data);
          $this->load->view('includes/_footer');
      $this->load->view('includes/_wrapper_end');


        } else {
                redirect(base_url(), 'refresh');
        }

  }

  public function DropStudentStubject(){

        if($this->session->userdata('user_id') != null) {
          $teachId = $this->session->userdata('user_id');
          $StudID = $this->input->post('checkbox_value');

              for ($i=0; $i < count($StudID) ; $i++) {
              $this->ClassStudent_model->DropStudent($StudID[$i],$teachId);
              }

  } else {
          redirect(base_url(), 'refresh');
  }
  }

//
// public function GetSubject(){
//         if($this->session->userdata('user_id') != null) {
//               $userID = $this->session->userdata('user_id');
//   $ClassID = array();
//   $subcodeID =  $this->input->post('SubcodeID');
//   if($subcodeID){
//   $con['conditions'] = array('subcodeID'=>$subcodeID);
//   $ClassID = $this->ClassStudent_model->GetSubjectCode($con,$userID);
//   }
//   echo json_encode($ClassID);
//
// } else {
//         redirect(base_url(), 'refresh');
// }
// }
public function GetStudentlist(){
  if($this->session->userdata('user_id') != null) {
  $userID = $this->session->userdata('user_id');
  $data = array();
  $studentList =  $this->input->post('bySubcode');
  if($studentList){
  $con['conditions'] = array('studentList'=>$studentList);
  $data = $this->ClassStudent_model->GetListStudent($con,$userID);
  }
  echo json_encode($data);

} else {
        redirect(base_url(), 'refresh');
}
}


}
