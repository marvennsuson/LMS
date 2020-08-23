<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('migration_home', 'home');
    }


	public function index()
	{
        $data['title'] = "Home | NVAC"; 
        
        $this->load->view('includes/_wrapper_start');
        $this->load->view('includes/_head');
        $this->load->view('includes/_navbar');
        $this->load->view('home', $data);
        $this->load->view('includes/_footer');
        $this->load->view('includes/_wrapper_end');
	}

}