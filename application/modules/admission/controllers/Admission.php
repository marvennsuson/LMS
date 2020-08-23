<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admission extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('migration_admission', 'admission');
    }


	public function index()
	{
        $data['title'] = "Admission | NVAC"; 
        
        $this->load->view('includes/_wrapper_start');
        $this->load->view('includes/_head');
        $this->load->view('includes/_navbar');
        $this->load->view('admission', $data);
        $this->load->view('includes/_footer');
        $this->load->view('includes/_wrapper_end');
    }
    
    public function add_online_admission()
    {
        $this->output->enable_profiler(false);
        $this->form_validation->set_rules('select_student', 'Student Type', '');
        $this->form_validation->set_rules('select_grade', 'Grade', '');
        $this->form_validation->set_rules('select_strand', 'Strand', '');
        $this->form_validation->set_rules('radio_qvr', 'QVR', '');
        $this->form_validation->set_rules('input_course', 'Course', '');
        $this->form_validation->set_rules('input_term', 'Term', '');
        $this->form_validation->set_rules('input_date', 'Date Filed', '');
        $this->form_validation->set_rules('input_firstname', 'First Name', '');
        $this->form_validation->set_rules('input_middlename', 'Middle Name', '');
        $this->form_validation->set_rules('input_lastname', 'Last Name', '');
        $this->form_validation->set_rules('input_birthdate', 'Birth Date', '');
        $this->form_validation->set_rules('input_birthplace', 'Birth Place', '');
        $this->form_validation->set_rules('select_sex', 'Sex', '');
        $this->form_validation->set_rules('input_nationality', 'Nationality', '');
        $this->form_validation->set_rules('input_weight', 'Height', '');
        $this->form_validation->set_rules('input_height', 'Firstname', '');
        $this->form_validation->set_rules('radio_healthcondition', 'Health Condition', '');
        $this->form_validation->set_rules('input_address', 'Address', '');
        $this->form_validation->set_rules('input_telephone', 'Telephone Number', '');
        $this->form_validation->set_rules('input_cellphone', 'Cellphone Number', '');
        $this->form_validation->set_rules('input_email', 'Email', 'valid_email');
        $this->form_validation->set_rules('input_religion', 'Religion', '');
        $this->form_validation->set_rules('input_churchmembership', 'Church Membership', '');
        $this->form_validation->set_rules('input_missionconference', 'Mission/Conference', '');
        $this->form_validation->set_rules('input_baptismdate', 'Baptism Date', '');
        $this->form_validation->set_rules('input_schoolattended', 'School Attended', '');
        $this->form_validation->set_rules('input_grade', 'Grade on last school attended', '');
        $this->form_validation->set_rules('input_yearattended', 'Year of Attendance', '');
        $this->form_validation->set_rules('input_schooladdress', 'Last school address', '');
        $this->form_validation->set_rules('input_honors', 'Honors', '');
        $this->form_validation->set_rules('input_awards', 'Awards', '');
        $this->form_validation->set_rules('input_genave', 'General Average', '');
        $this->form_validation->set_rules('input_fathersname', 'Father\'s Name', '');
        $this->form_validation->set_rules('input_fathersoccupation', 'Father\'s Occupation', '');
        $this->form_validation->set_rules('input_fathersreligion', 'Father\'s Religion', '');
        $this->form_validation->set_rules('input_fathersaddress', 'Father\'s Address', '');
        $this->form_validation->set_rules('input_mothersname', 'Father\'s Name', '');
        $this->form_validation->set_rules('input_mothersoccupation', 'Mother\'s Occupation', '');
        $this->form_validation->set_rules('input_mothersreligion', 'Mother\'s Religion', '');
        $this->form_validation->set_rules('input_mothersaddress', 'Mother\'s Address', '');
        $this->form_validation->set_rules('input_familycount', 'Family Count', '');
        $this->form_validation->set_rules('input_brothers', 'Brothers', '');
        $this->form_validation->set_rules('input_sisters', 'Sisters', '');
        $this->form_validation->set_rules('input_annualfamilyincome', 'Annual Family Income', '');
        $this->form_validation->set_rules('input_willingness', 'Willing to attend NVAC', '');
        $this->form_validation->set_rules('input_whoencourage', 'Who encourage you to enroll at NVAC', '');
        $this->form_validation->set_rules('input_personresponsible', 'Person Responmsible for school account', '');
        $this->form_validation->set_rules('input_personresponsibleaddress', 'Address (if other than the parents)', '');
        $this->form_validation->set_rules('select_dormitory', 'Stay in dormitory', '');
        $this->form_validation->set_rules('input_whereandwhom', 'Where and Whom', '');
        $this->form_validation->set_rules('input_relationship', 'Relationship', '');
        $this->form_validation->set_rules('textarea_whynvac', 'Why NVAC', '');

        if ($this->form_validation->run() == FALSE)
        {
            $data['response'] = "false";
            $data['message'] = validation_errors();
	        // $data['message'] = $this->form_validation->error_array();
        } else {

            $studentData = array(
                'student_type' => trim(strtolower($this->input->post('select_student'))),
                'grade' => trim(strtolower($this->input->post('select_grade'))),
                'strand' => trim(strtolower($this->input->post('select_strand'))),
                'course' => trim(strtolower($this->input->post('input_course'))),
                'term' => trim(strtolower($this->input->post('input_term'))),
                'date_filed' => trim(strtolower($this->input->post('input_date'))),
                'firstname' => trim(strtolower($this->input->post('input_firstname'))),
                'middlename' => trim(strtolower($this->input->post('input_middlename'))),
                'lastname' => trim(strtolower($this->input->post('input_lastname'))),
                'birthdate' => trim(strtolower($this->input->post('input_birthdate'))),
                'birthplace' => trim(strtolower($this->input->post('input_birthplace'))),
                'sex' => trim(strtolower($this->input->post('select_sex'))),
                'nationality' => trim(strtolower($this->input->post('input_nationality'))),
                'weight' => trim(strtolower($this->input->post('input_weight'))),
                'height' => trim(strtolower($this->input->post('input_height'))),
                'healthcondition' => trim(strtolower($this->input->post('radio_healthcondition'))),
                'address' => trim(strtolower($this->input->post('input_address'))),
                'telephone' => trim(strtolower($this->input->post('input_telephone'))),
                'cellphone' => trim(strtolower($this->input->post('input_cellphone'))),
                'email' => trim(strtolower($this->input->post('input_email'))),
                'religion' => trim(strtolower($this->input->post('input_religion'))),
                'churchmembership' => trim(strtolower($this->input->post('input_churchmembership'))),
                'missionconference' => trim(strtolower($this->input->post('input_missionconference'))),
                'baptismdate' => trim(strtolower($this->input->post('input_baptismdate'))),
                'schoolattended' => trim(strtolower($this->input->post('input_schoolattended'))),
                'prev_grade' => trim(strtolower($this->input->post('input_grade'))),
                'yearattended' => trim(strtolower($this->input->post('input_yearattended'))),
                'schooladdress' => trim(strtolower($this->input->post('input_schooladdress'))),
                'honors' => trim(strtolower($this->input->post('input_honors'))),
                'awards' => trim(strtolower($this->input->post('input_awards'))),
                'genave' => trim(strtolower($this->input->post('input_genave'))),
                'fathersname' => trim(strtolower($this->input->post('input_fathersname'))),
                'fathersoccupation' => trim(strtolower($this->input->post('input_fathersoccupation'))),
                'fathersreligion' => trim(strtolower($this->input->post('input_fathersreligion'))),
                'fathersaddress' => trim(strtolower($this->input->post('input_fathersaddress'))),
                'mothersname' => trim(strtolower($this->input->post('input_mothersname'))),
                'mothersoccupation' => trim(strtolower($this->input->post('input_mothersoccupation'))),
                'mothersreligion' => trim(strtolower($this->input->post('input_mothersreligion'))),
                'mothersaddress' => trim(strtolower($this->input->post('input_mothersaddress'))),
                'familycount' => trim(strtolower($this->input->post('input_familycount'))),
                'brothers' => trim(strtolower($this->input->post('input_brothers'))),
                'sisters' => trim(strtolower($this->input->post('input_sisters'))),
                'annualfamilyincome' => trim(strtolower($this->input->post('input_annualfamilyincome'))),
                'willingness' => trim(strtolower($this->input->post('input_willingness'))),
                'whoencourage' => trim(strtolower($this->input->post('input_whoencourage'))),
                'personresponsible' => trim(strtolower($this->input->post('input_personresponsible'))),
                'personresponsibleaddress' => trim(strtolower($this->input->post('input_personresponsibleaddress'))),
                'dormitory' => trim(strtolower($this->input->post('select_dormitory'))),
                'whereandwhom' => trim(strtolower($this->input->post('input_whereandwhom'))),
                'relationship' => trim(strtolower($this->input->post('input_relationship'))),
                'whynvac' => trim(strtolower($this->input->post('textarea_whynvac'))),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            );

            $this->admission->insertAdmission($studentData);
	        
	        $data['response'] = "true";
	        $data['message'] = 'Admission Created!';
        }
	    echo json_encode($data);
    }

}