<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schoolfee_controller extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('migration_parent_school_fee', 'school_fee');
  }

  function index()
  {
    if($this->session->userdata('user_id') != null) {

      $aside = array(
          'menu'  => 'dashboardParent',
          'submenu'     => 'schoolfee',
      );


      $childInfo = $this->school_fee->get_all_child_info($_SESSION['email']);


      $chilldBillInfo = array();
      foreach ($childInfo as $child) {
        $childStudentFee = $this->school_fee->get_child_student_fee($child['student_number']);
        $chilldBillInfo[] = $childStudentFee;
      }
      
      $this->session->set_flashdata($aside);
      $data['student_fees'] = $chilldBillInfo;
      $data['title'] = "Dashboard - NVAC Portal";
      $userID = $this->session->userdata('user_id');
      $userEmail = $this->session->userdata('email');
      $this->load->view('includes/_wrapper_start');
      $this->load->view('includes/_navbar');
      $this->load->view('includes/_aside');
      $this->load->view('fees/SchoolFeeIndex', $data);
      $this->load->view('includes/_footer');
      $this->load->view('includes/_wrapper_end');
    } else {
        redirect(base_url(), 'refresh');
      }
  }

  public function read_pdf()
  {
    if ($_GET['file']) {
      $data['title'] = $_GET['file'];
      $data['filename'] = $_GET['file'];

      $aside = array(
        'menu'  => 'dashboardParent',
        'submenu'     => 'schoolfee',
      );

    
      $this->session->set_flashdata($aside);
      $this->load->view('includes/_wrapper_start');
      $this->load->view('includes/_navbar');
      $this->load->view('includes/_aside');
      $this->load->view('fees/school_fee_pdf', $data);
      $this->load->view('includes/_footer');
      $this->load->view('includes/_wrapper_end');
    }else{
      redirect(base_url(), 'refresh');
    }
    
  }

}
