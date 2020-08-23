<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('migration_dashboard', 'dashboard');
    }


	public function index()
	{
        if($this->session->userdata('user_id') != null) {
            // redirect(base_url('dashboard'), 'refresh');
            $data['title'] = "Dashboard - NVAC Portal";

            $this->load->view('includes/_wrapper_start');
            $this->load->view('includes/_navbar');
            $this->load->view('includes/_aside');
            $this->load->view('dashboard', $data);
            $this->load->view('includes/_footer');
		    $this->load->view('includes/_wrapper_end');
		} else {
            redirect(base_url(), 'refresh');
		}
	}

	public function teacher_ebooks(){
		if($this->session->userdata('user_id') != null) {
				// redirect(base_url('dashboard'), 'refresh');
				$data['title'] = "Dashboard - NVAC Portal";

				$this->load->view('includes/_wrapper_start');
				$this->load->view('includes/_navbar');
				$this->load->view('includes/_aside');
				$this->load->view('teacher_ebooks', $data);
				$this->load->view('includes/_footer');
		$this->load->view('includes/_wrapper_end');
} else {
				redirect(base_url(), 'refresh');
}
	}


	public function teacher_upload(){
		if($this->session->userdata('user_id') != null) {
				// redirect(base_url('dashboard'), 'refresh');
				$data['title'] = "Dashboard - NVAC Portal";

				$this->load->view('includes/_wrapper_start');
				$this->load->view('includes/_navbar');
				$this->load->view('includes/_aside');
				$this->load->view('teacher_upload', $data);
				$this->load->view('includes/_footer');
		$this->load->view('includes/_wrapper_end');
} else {
				redirect(base_url(), 'refresh');
}
	}


}
