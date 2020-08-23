<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Elearning extends CI_Controller {

	function __construct() {
    parent::__construct();
		$this->load->model('Elearning_model');
		$this->load->model('migration_elearning', 'elearning');
    }


	// public function index()
	// {
    //     if($this->session->userdata('user_id') != null) {
    //         // redirect(base_url('elearning'), 'refresh');
    //         $data['title'] = "E-learning - NVAC Portal";

    //         $this->load->view('includes/_wrapper_start');
    //         $this->load->view('includes/_navbar');
    //         $this->load->view('includes/_aside');
    //         $this->load->view('elearning', $data);
    //         $this->load->view('includes/_footer');
	// 	    $this->load->view('includes/_wrapper_end');
	// 	} else {
    //         redirect(base_url(), 'refresh');
	// 	}
    // }

    public function ebooks()
	{
        if($this->session->userdata('user_id') != null) {
            // redirect(base_url('elearning'), 'refresh');
            $data['title'] = "E-learning - NVAC Portal";

						$data['row'] = $this->Elearning_model->Retrive_files();
						$data['school_lvl'] = $this->Elearning_model->set_school_lvl();
						// $data['year_lvl'] = $this->Elearning_model->set_yearlvl();
						// $data['bysection'] = $this->Elearning_model->set_section_lvl();
						// $data['bysubject'] = $this->Elearning_model->set_subject();
            $this->load->view('includes/_wrapper_start');
            $this->load->view('includes/_navbar');
            $this->load->view('includes/_aside');
            $this->load->view('ebooks', $data);
            $this->load->view('includes/_footer');
		    $this->load->view('includes/_wrapper_end');
		} else {
            redirect(base_url(), 'refresh');
		}
    }





    public function download_center()
	{
        if($this->session->userdata('user_id') != null) {
            // redirect(base_url('elearning'), 'refresh');
            $data['title'] = "E-learning - NVAC Portal";

            $this->load->view('includes/_wrapper_start');
            $this->load->view('includes/_navbar');
            $this->load->view('includes/_aside');
            $this->load->view('download_center', $data);
            $this->load->view('includes/_footer');
		    $this->load->view('includes/_wrapper_end');
		} else {
            redirect(base_url(), 'refresh');
		}
	}



	public function Getyearlvl(){
		$yearLvl = array();
			$schID =  $this->input->post('schID');
			if($schID){
					$con['conditions'] = array('schID'=>$schID);
					$yearLvl = $this->Elearning_model->getSchoolId($con);
			}
			echo json_encode($yearLvl);
	}


			public function Getyearbysec(){
				$yearbySection = array();
 $byyrID = $this->input->post('yearlvlID');
 if($byyrID){
		 $con['conditions'] = array('byyrID'=>$byyrID);
		 $yearbySection = $this->Elearning_model->getYearBysection($con);
 }
 echo json_encode($yearbySection);
			}

			public function GetbySubjcode(){
				$bysubjcode = array();
 $bySubcodeID = $this->input->post('BysubjCode');
 if($bySubcodeID){
		 $con['conditions'] = array('bySubcodeID'=>$bySubcodeID);
		 $bysubjcode = $this->Elearning_model->GetSectionBySubjCode($con);
 }
 echo json_encode($bysubjcode);
			}

}
