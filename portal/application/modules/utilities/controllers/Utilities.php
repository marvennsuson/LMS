<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilities extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('migration_utilities', 'utilities');
    }


	// public function index()
	// {
    //     if($this->session->userdata('user_id') != null) {
    //         // redirect(base_url('utilities'), 'refresh');
    //         $data['title'] = "Portal - NVAC Portal"; 
            
    //         $this->load->view('includes/_wrapper_start');
    //         $this->load->view('includes/_navbar');
    //         $this->load->view('includes/_aside');
    //         $this->load->view('utilities', $data);
    //         $this->load->view('includes/_footer');
	// 	    $this->load->view('includes/_wrapper_end');
	// 	} else {
    //         redirect(base_url(), 'refresh');
	// 	}
    // }
    
    public function add_job_index()
	{
        if($this->session->userdata('user_id') != null) {
            // redirect(base_url('utilities'), 'refresh');
            // $data['title'] = "Portal | Reto";
            $data['module_title'] = "Utilities";
            $data['module_function'] = "Add Job"; 
            
            $this->load->view('includes/_wrapper_start');
            $this->load->view('includes/_navbar');
            $this->load->view('includes/_aside');
            $this->load->view('utilities', $data);
            $this->load->view('includes/_footer');
		    $this->load->view('includes/_wrapper_end');
		} else {
            redirect(base_url(), 'refresh');
		}
    }
    
    public function add_job()
    {
        $this->output->enable_profiler(false);
        $this->form_validation->set_rules('input_job_title', 'Job Title', 'required|alpha_numeric');
        $this->form_validation->set_rules('input_company', 'Company', 'required');
        $this->form_validation->set_rules('input_location', 'Location', 'required');
        $this->form_validation->set_rules('input_salary', 'Salary', 'required');
        $this->form_validation->set_rules('textarea_job_description', 'Job Description', 'required');
        $this->form_validation->set_rules('textarea_job_qualification', 'Job Qualifications', 'required');
        $this->form_validation->set_rules('textarea_skills_required', 'Skills Required', 'required');
        $this->form_validation->set_rules('textarea_job_details', 'Job Details', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $data['response'] = "false";
            $data['message'] = validation_errors();
	        // $data['message'] = $this->form_validation->error_array();
        } else {

            $createCategory['category_name'] = trim($this->input->post('input_job_category'));
            $job_category_id = $this->utilities->CreateJobCategory($createCategory);

            $createJob = array(
                'job_title' => trim(ucwords($this->input->post('input_job_title'))),
                'job_category_id' => $job_category_id,
                'company' => trim($this->input->post('input_company')),
                'location' => trim($this->input->post('input_location')),
                'salary' => str_replace(',','',trim($this->input->post('input_salary'))),
                'job_description' => trim($this->input->post('textarea_job_description')),
				'job_qualification' => trim($this->input->post('textarea_job_qualification')),
				'skills_required' => trim($this->input->post('textarea_skills_required')),
				'job_details' => trim($this->input->post('textarea_job_details')),
            );
            $this->utilities->CreateJob($createJob);
	        
	        $data['response'] = "true";
	        $data['message'] = 'Job Created!';
        }
	    echo json_encode($data);
    }

}