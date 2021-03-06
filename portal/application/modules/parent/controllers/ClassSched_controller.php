<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClassSched_controller extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    if($this->session->userdata('user_id') != null) {

      $aside = array(
          'menu'  => 'dashboardParent',
          'submenu'     => 'schedule',
      );
      $this->session->set_flashdata($aside);
      $data['title'] = "Dashboard - NVAC Portal";
      $userID = $this->session->userdata('user_id');
      $userEmail = $this->session->userdata('email');
      $this->load->view('includes/_wrapper_start');
      $this->load->view('includes/_navbar');
      $this->load->view('includes/_aside');
      $this->load->view('schedule/ScheduleIndex', $data);
      $this->load->view('includes/_footer');
  $this->load->view('includes/_wrapper_end');
  } else {
          redirect(base_url(), 'refresh');
  }
  }

}
