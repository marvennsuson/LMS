<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admissions extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('migration_admissions', 'admissions');
    }

	// public function index()
	// {
    //     if($this->session->userdata('user_id') != null) {
    //         // redirect(base_url('admissions'), 'refresh');
    //         $data['title'] = "Admissions - NVAC Portal"; 
            
    //         $this->load->view('includes/_wrapper_start');
    //         $this->load->view('includes/_navbar');
    //         $this->load->view('includes/_aside');
    //         $this->load->view('admissions', $data);
    //         $this->load->view('includes/_footer');
	// 	    $this->load->view('includes/_wrapper_end');
	// 	} else {
    //         redirect(base_url(), 'refresh');
	// 	}
    // }

    public function pagination_config()
    {
        $config = array();
        $config['uri_segment'] = 3;
        $config["full_tag_open"] = '<ul class="pagination pagination-sm no-margin pull-left">';
        $config["full_tag_close"] = '</ul>';	
        $config["first_link"] = "&laquo;";
        $config["first_tag_open"] = "<li>";
        $config["first_tag_close"] = "</li>";
        $config["last_link"] = "&raquo;";
        $config["last_tag_open"] = "<li>";
        $config["last_tag_close"] = "</li>";
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '<li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '<li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
    }
    
    public function list_of_admissions()
	{
        if($this->session->userdata('user_id') != null) {
            // redirect(base_url('admissions'), 'refresh');
            // $this->pagination_config();
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
            $config['base_url'] = base_url('/admissions/list_of_admissions/');
            $config['total_rows'] = $this->admissions->count_all_admissions();
            $this->pagination->initialize($config);
            $page = ( $this->uri->segment(3) ) ? $this->uri->segment(3) : 0;
            $data['admission_lists'] = $this->admissions->admission_lists_by_page($config['per_page'], $page);
            $data['links'] = $this->pagination->create_links();

            $data['user_id'] = $this->session->userdata('user_id');

            $data['title'] = "Admissions - NVAC Portal";
            $data['module'] = "Admissions";
            $data['function'] = "List of Admissions";

            $aside = array(
                'menu'  => 'admission',
                'submenu'     => 'list_of_admissions',
            );
            $this->session->set_flashdata($aside);
            
            $this->load->view('includes/_wrapper_start');
            $this->load->view('includes/_navbar');
            $this->load->view('includes/_aside');
            $this->load->view('admissions', $data);
            $this->load->view('includes/_footer');
		    $this->load->view('includes/_wrapper_end');
		} else {
            redirect(base_url(), 'refresh');
		}
    }
    
    public function delete_admission()
    {
        $this->form_validation->set_rules('admission_id', 'Admission ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('admission_id')) > 0 || !empty(trim($this->input->post('admission_id')))) {
                $data['admission_details'] = $this->admissions->delete_admission(trim($this->input->post('admission_id')));
                $data['response'] = 'true';
                $data['message'] = 'Admission Deleted';
                $this->load->view('admissions', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No admission selected';
            }
        }
    }

    public function read_admission()
    {
        $this->form_validation->set_rules('admission_id', 'Admission ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('admission_id')) > 0 || !empty(trim($this->input->post('admission_id')))) {
                $data['admission_details'] = $this->admissions->read_admission(trim($this->input->post('admission_id')));
                $data['response'] = 'true';
                $data['message'] = 'Read admission Successful';
                $this->load->view('read_admission', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No admission selected';
            }
        }
    }

    public function read_registration()
    {
        $this->form_validation->set_rules('admission_id', 'Admission ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('admission_id')) > 0 || !empty(trim($this->input->post('admission_id')))) {
                $data['admission_details'] = $this->admissions->read_admission_row(trim($this->input->post('admission_id')));
                $data['classes'] = $this->admissions->read_classes();
                // $data['teachers'] = $this->admissions->read_teachers();
                // $data['subjects'] = $this->admissions->read_subjects();
                // $data['sections'] = $this->admissions->read_sections();
                // $data['schedules'] = $this->admissions->read_schedules();
                $data['response'] = 'true';
                $data['message'] = 'Read admission Successful';
                $this->load->view('read_registration', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No admission selected';
            }
        }
    }

    public function read_class_details()
    {
        $this->form_validation->set_rules('classcode', 'Class Code', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('classcode')) > 0 || !empty(trim($this->input->post('classcode')))) {
                $data['class_details'] = $this->admissions->read_class_details($this->input->post('classcode'));
                
                $data['response'] = 'true';
                $data['message'] = 'Read Class Details Successful';
                $this->load->view('class_details', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Class Details Selected';
            }
        }
    }

    public function add_class_to_student()
    {
        $this->form_validation->set_rules('reg_select_classcode', 'Class Code', 'required');
        $this->form_validation->set_rules('admission_id', 'Admission ID', 'required');
        $this->form_validation->set_rules('student_email', 'Student Email', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {

            $reg_data = array(
                'classcode' => trim($this->input->post('reg_select_classcode')),
                'admission_id' => trim($this->input->post('admission_id')),
                'enrollment_process' => 'registered',
            );

            if( trim($this->input->post('reg_select_classcode')) > 0 || !empty(trim($this->input->post('reg_select_classcode')))) {

                $studentNumber = date('Y').'-'.str_pad(trim($this->input->post('admission_id')),4,"0",STR_PAD_LEFT);
                
                $account_credentials = array(
                    'email' => trim($this->input->post('student_email')),
                    'password' => trim($this->input->post('student_email')),
                    'student_number' => $studentNumber,
                    'role' => 4,
                );

                $config['protocol'] = 'smtp';
                $config['charset'] = 'iso-8859-1';
                $config['wordwrap'] = TRUE;
                $config['smtp_host'] = 'smtp.hostinger.ph';
                $config['smtp_port'] = '587';
                $config['mailtype'] = 'html';

                $this->email->from('nvac.edu.ph', 'NVAC');
                $this->email->to($this->input->post('student_email'));
                $this->email->subject('NVAC LMS Login Credentials');
                $this->email->message('Email/Username: '.$studentNumber.'<br> Password: '.trim($this->input->post('student_email')));
                $this->email->send();

                $this->admissions->create_account($account_credentials);
                $this->admissions->register_student($reg_data);
                $data['response'] = 'true';
                $data['message'] = 'Register Successful';
                // $this->load->view('read_registration', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No admission selected';
            }
        }
        echo json_encode($data);
    }


    public function bulk_registration()
	{
        if($this->session->userdata('user_id') != null) {
            // redirect(base_url('admissions'), 'refresh');
            $data['title'] = "Admissions - NVAC Portal"; 
            $data['module'] = "Admissions";
            $data['function'] = "Bulk Registration";

            $aside = array(
                'menu'  => 'admission',
                'submenu'     => 'bulk_registration',
            );
            $this->session->set_flashdata($aside);

            // $data['admission_lists'] = $this->admissions->for_bulk_registration('admission');
            
            $this->load->view('includes/_wrapper_start');
            $this->load->view('includes/_navbar');
            $this->load->view('includes/_aside');
            $this->load->view('bulk_registration', $data);
            $this->load->view('includes/_footer');
		    $this->load->view('includes/_wrapper_end');
		} else {
            redirect(base_url(), 'refresh');
		}
    }

    public function search_student_by_level()
    {
        $this->form_validation->set_rules('studentlevel', 'Student Level', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('studentlevel')) > 0 || !empty(trim($this->input->post('studentlevel')))) {
                $data['student_type'] = $this->admissions->search_student_by_level(trim($this->input->post('studentlevel')));
                $data['classes'] = $this->admissions->read_classes();
                $data['response'] = 'true';
                $data['message'] = 'Select Student Type Successful';
                $this->load->view('search_student_by_level_result', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Student Type selected';
            }
        }
        // echo json_encode($data);
    }

    public function bulk_registration_insert()
    {
        $this->form_validation->set_rules('toBulkRegister[]', 'Check Box', 'required');
        $this->form_validation->set_rules('bulk_reg_select_class_code[]', 'Class Code', 'required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {

            $checkboxPost = $_POST;
            $checked_count = count($_POST['toBulkRegister']);

            $config['protocol'] = 'smtp';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['smtp_host'] = 'smtp.hostinger.ph';
            $config['smtp_port'] = '587';
            $config['mailtype'] = 'html';
            // $config['smtp_user'] = 'admin@nvac.edu.ph';
            // $config['smtp_pass'] = 'admin';
            // $this->email->initialize($config);

            for($i=0; $i<$checked_count; $i++)
            {
                $checkboxPost['toBulkRegister'][$i];

                $reg_data = array(
                    'classcode' => $_POST['bulk_reg_select_class_code'][$i],
                    'admission_id' => $_POST['toBulkRegister_admission_id'][$i],
                    'enrollment_process' => 'registered',
                );

                $studentNumber = date('Y').'-'.str_pad($reg_data['admission_id'],4,"0",STR_PAD_LEFT);
                
                $account_credentials = array(
                    'email' => trim($_POST['toBulkRegister_email'][$i]),
                    'password' => trim($_POST['toBulkRegister_email'][$i]),
                    'student_number' => $studentNumber,
                    'role' => 4,
                );

                $this->email->from('nvac.edu.ph', 'NVAC');
                $this->email->to($_POST['toBulkRegister_email'][$i]);
                $this->email->subject('NVAC LMS Login Credentials');
                $this->email->message('Email/Username: '.$studentNumber.'<br> Password: '.trim($_POST['toBulkRegister_email'][$i]));

                $this->email->send();

                $this->admissions->create_account($account_credentials);
                $this->admissions->register_student($reg_data);
            }

            $data['response'] = 'true';
            $data['message'] = 'Register Successful';
    
        }
        echo json_encode($data);
    }


}