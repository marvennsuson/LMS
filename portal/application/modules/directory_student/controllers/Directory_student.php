<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Directory_student extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('migration_directory_student', 'directory_student');
    }

    public function student_information()
	{
        if($this->session->userdata('user_id') != null) {
            $config = array();
            $config['base_url'] = base_url('/directory_student/student_information/');
            $config['total_rows'] = $this->directory_student->count_all_students();
            $config['per_page'] = 10;
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
            $this->pagination->initialize($config);
            $page = ( $this->uri->segment(3) ) ? $this->uri->segment(3) : 0;
            $data["student_lists"] = $this->directory_student->student_lists_by_page($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();

            $data['title'] = "Student Directory - NVAC Portal";
            $data['module'] = "Student Information";
            $data['function'] = "Student Information";

            $aside = array(
                'menu'  => 'student directory',
                'submenu'     => 'student_information',
            );
            $this->session->set_flashdata($aside);

            // $data['classes'] = $this->activities->read_subjects_by_class($this->session->classcode);
            // print_r($data);exit;
            $this->load->view('includes/_wrapper_start');
            $this->load->view('includes/_navbar');
            $this->load->view('includes/_aside');
            $this->load->view('directory_student_index', $data);
            $this->load->view('includes/_footer');
		    $this->load->view('includes/_wrapper_end');
		} else {
            redirect(base_url(), 'refresh');
		}
    }

    public function generate_student_table(){
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));


        $student = $this->directory_student->student_list();

        $data = array();

        foreach($student->result() as $std) {

             $data[] = array(
                '<input type="checkbox" id="chk_student_delete" name="chk_student_delete[]" value="'.$std->id.'">',
                $std->student_number,
                  $std->firstname.' '.$std->middlename.' '.$std->lastname,
                  $std->sex,
                  $std->student_type,
                 '<button type="button" class="btn btn-success btn-sm edit" id="btn_edit" data-classid="student-'.$std->id.'" data-toggle="modal" data-target="#student_edit"><i class="fa fa-edit"></i> Edit</button></a>'.
                 '<button type="button" class="btn btn-info btn-sm read" id="btn_read" data-classid="student-'.$std->id.'" data-toggle="modal" data-target="#student_read"><i class="fa fa-eye"></i> View</button>'.
                 '<button type="button" class="btn btn-danger btn-sm delete"  data-classid="student-'.$std->id.'" data-toggle="modal" data-target="#student_delete"><i class="fa fa-trash"></i> Delete</button>'
             );
        }

        $output = array(
             "draw" => $draw,
               "recordsTotal" => $student->num_rows(),
               "recordsFiltered" => $student->num_rows(),
               "data" => $data
          );
        echo json_encode($output);
        exit();
    }

    public function generate_subject_table(){
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));


        $subject = $this->directory_student->subject_list();

        $data = array();

        foreach($subject->result() as $sub) {

             $data[] = array(
                 '<input type="checkbox" id="chk_subject_delete" name="chk_subject_delete[]" value="'.$sub->id.'">',
                $sub->student_id,
                  $sub->firstname.' '.$sub->middlename.' '.$sub->lastname,
                  $sub->student_type,
                  $sub->subject_name,
                  $sub->subjectcode,
                  $sub->name,
                  $sub->schedule,
                  $sub->section,
                 '<button type="button" title="Edit" class="btn btn-success btn-sm btn-flat edit" id="btn_edit" data-classid="subject-'.$sub->id.'" data-toggle="modal" data-target="#subject_edit"><i style="color:#fff; font-size:14px" class="fa fa-edit"></i> </button></a>'.
                 '<button type="button" title="View" class="btn btn-info btn-sm btn-flatread mr-1 ml-1" id="btn_read" data-classid="subject-'.$sub->id.'" data-toggle="modal" data-target="#subject_read"><i style="color:#fff; font-size:14px" class="fa fa-eye"></i> </button>'.
                 '<button type="button" title="delete" class="btn btn-danger btn-sm btn-flat delete"  data-classid="subject-'.$sub->id.'" data-toggle="modal" data-target="#subject_delete"><i style="color:#fff; font-size:14px" class="fa fa-trash"></i> </button>'
             );
        }

        $output = array(
             "draw" => $draw,
               "recordsTotal" => $subject->num_rows(),
               "recordsFiltered" => $subject->num_rows(),
               "data" => $data
          );
        echo json_encode($output);
        exit();
    }
    public function delete_student()
    {
        $this->form_validation->set_rules('id', 'Student ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('id')) > 0 || !empty(trim($this->input->post('id')))) {
                $data['student_delete_details'] = $this->directory_student->delete_student(trim($this->input->post('id')));
                $data['response'] = 'true';
                $data['message'] = 'Student Deleted';
                // $this->load->view('directory_student_index', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Student selected';
            }
        }
    }

    public function delete_subject()
    {
        $this->form_validation->set_rules('id', 'Subject ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('id')) > 0 || !empty(trim($this->input->post('id')))) {
                $data['student_delete_details'] = $this->directory_student->delete_subject(trim($this->input->post('id')));
                $data['response'] = 'true';
                $data['message'] = 'Subject Deleted';
                // $this->load->view('directory_student_index', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Subject selected';
            }
        }
    }

    public function delete_block()
    {
        $this->form_validation->set_rules('id', 'Student ID', 'trim|required');
        $this->form_validation->set_rules('code', 'Block Code', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $studentId = $this->input->post('id');
            $blockCode = $this->input->post('code');
            if( $studentId != '' && $blockCode != '') {
                $data['student_delete_details'] = $this->directory_student->delete_block($studentId,$blockCode);
                $data['response'] = 'true';
                $data['message'] = 'Subject Deleted';
                // $this->load->view('directory_student_index', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Subject selected';
            }
        }
    }

    public function bulk_delete_subject(){
        $this->form_validation->set_rules('id', 'Subject IDs', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $subjectIds = explode(',', trim($this->input->post('id')));

            // print_r($subjectIds);exit;
            if( $subjectIds > 0 || !empty($subjectIds)) {
                for ($i=0; $i < count($subjectIds); $i++) {
                    $deleteSubjects = $this->directory_student->delete_subject($subjectIds[$i]);
                }
                $data['response'] = 'true';
                $data['message'] = 'Subject Deleted';
                // $this->load->view('directory_student_index', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Subject selected';
            }
        }
    }
    public function bulk_delete_student(){
        $this->form_validation->set_rules('id', 'Student IDs', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $studentIds = explode(',', trim($this->input->post('id')));

            // print_r($subjectIds);exit;
            if( $studentIds > 0 || !empty($studentIds)) {
                for ($i=0; $i < count($studentIds); $i++) {
                    $deleteStudents = $this->directory_student->delete_student($studentIds[$i]);
                }
                $data['response'] = 'true';
                $data['message'] = 'Students Deleted';
                // $this->load->view('directory_student_index', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Students selected';
            }
        }
    }

    public function read_student()
    {
        $this->form_validation->set_rules('id', 'Student ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('id')) > 0 || !empty(trim($this->input->post('id')))) {
                $data['student_details'] = $this->directory_student->read_student(trim($this->input->post('id')));
                $data['response'] = 'true';
                $data['message'] = 'Read Student Successful';
                $this->load->view('response/_read_student', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Student selected';
            }
        }
    }

    public function edit_student()
    {
        $this->form_validation->set_rules('id', 'Student ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('id')) > 0 || !empty(trim($this->input->post('id')))) {
                $data['student_details'] = $this->directory_student->read_student(trim($this->input->post('id')));
                $data['response'] = 'true';
                $data['message'] = 'Read Student Successful';
                $this->load->view('response/_edit_student', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Student selected';
            }
        }
    }

    public function update_register_student()
    {
        // echo json_encode($this->input->post('subjectCodes'));exit;
        $subjectCodes = explode(',',$this->input->post('subjectCodes'));
        $studentIds = explode(',', $this->input->post('studentIds'));
        if (empty($subjectCodes) || empty($studentIds)) {
            $data['response'] = "false";
            $data['message'] = "No subject data or Student Id";
        } else {
            // $subjectIds = explode(',',trim($this->input->post('input_subject_id')));
            // echo json_encode($studentIds);exit;
            // $students = $this->input->post('chk_students[]');
            $subjectInfo = array();
            if (count($subjectCodes) > 1) {
                for ($i=0; $i < count($subjectCodes) ; $i++) {

                    $getSubjects = $this->directory_student->get_subject_by_subj_code($subjectCodes[$i]);
                    $subjectInfo[] = $getSubjects;
                }
            }else{
                $getSubjects = $this->directory_student->get_subject_by_subj_code($subjectCodes[0]);
                $subjectInfo[] = $getSubjects;
            }


            // echo json_encode($subjectInfo);exit;

            // $data['subjects'] = $subjectInfo[0][0];
            $insertData = array();
            for ($i=0; $i < count($studentIds) ; $i++) {

                for ($j=0; $j <  count($subjectInfo); $j++) {
                    $insertData[$i][$j]['subjectcode'] = $subjectInfo[$j][0]['subjectcode'];
                    $insertData[$i][$j]['classcode'] = $subjectInfo[$j][0]['blockclassid'];
                    $insertData[$i][$j]['subject_name'] = $subjectInfo[$j][0]['subjectname'];
                    $insertData[$i][$j]['teacher_code'] = $subjectInfo[$j][0]['teacherid'];
                    $insertData[$i][$j]['section'] = $subjectInfo[$j][0]['section'];
                    $insertData[$i][$j]['schedule'] = $subjectInfo[$j][0]['schedule'];
                    $insertData[$i][$j]['adviser_teacher'] = 'TNVAC005';
                    $insertData[$i][$j]['subject_description'] = $subjectInfo[$j][0]['subjectdesc'];
                    $insertData[$i][$j]['student_id'] =  $studentIds[$i];
                }
            }

            $finalInsert = array();
            $subjCount = 0;
            foreach ($insertData as $key => $ins) {

                foreach ($ins as $key1 => $ins1) {
                    // $finalInsert[$subjCount]['subjectcode'] = $ins1['subjectcode'];
                    $finalInsert[$subjCount]['subjectcode'] = $ins1['subjectcode'];
                    $finalInsert[$subjCount]['classcode'] = $ins1['classcode'];
                    $finalInsert[$subjCount]['subject_name'] = $ins1['subject_name'];
                    $finalInsert[$subjCount]['teacher_code'] = $ins1['teacher_code'];
                    $finalInsert[$subjCount]['section'] = $ins1['section'];
                    $finalInsert[$subjCount]['schedule'] = $ins1['schedule'];
                    $finalInsert[$subjCount]['adviser_teacher'] = $ins1['adviser_teacher'];
                    $finalInsert[$subjCount]['subject_description'] = $ins1['subject_description'];
                    $finalInsert[$subjCount]['student_id'] = $ins1['student_id'];
                    $subjCount++;
                }
            }

            // echo json_encode($finalInsert);
            // $data['insertData'] = $finalInsert;
            if (!empty($finalInsert)) {
                $this->directory_student->register_student($finalInsert);
                $data['response'] = "true";
	            $data['message'] = 'Student Added!';
            }else{
                $data['response'] = 'false';
                $data['message'] = 'No Insert data';
            }

        }
	    echo json_encode($data);
    }

    public function edit_register_student()
    {
        $this->form_validation->set_rules('id', 'Subject ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $subjectId = $this->input->post('id');
            
            if( trim($subjectId) > 0 || !empty(trim($subjectId))) {
                // echo json_encode($subjectId);
                $subjectDetails = $this->directory_student->get_registered_subject_Code($subjectId);
                // echo json_encode($subjectDetails);
                $data['subject_details'] = $subjectDetails;
                $data['student_registered'] = $this->directory_student->get_subject_registered_students($subjectDetails['subjectcode']);
                $data['response'] = 'true';
                $data['message'] = 'Read Subject Successful';
                $this->load->view('response/_edit_register_student', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Student selected';
            }
        }
    }

    public function insert_edit_student()
    {
        $this->form_validation->set_rules('hidden_id', 'Student ID', 'required');
        $this->form_validation->set_rules('input_firstname', 'First Name', 'required');
        $this->form_validation->set_rules('input_middlename', 'Middle Name', '');
        $this->form_validation->set_rules('input_lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('input_email', 'Email', 'valid_email');
        $this->form_validation->set_rules('input_student_type', 'Student Type', 'required');
        $this->form_validation->set_rules('input_address', 'Address', 'required');
        $this->form_validation->set_rules('input_birthdate', 'Birth Day', 'required');
        $this->form_validation->set_rules('input_cellphone', 'Phone', 'required');
        $this->form_validation->set_rules('input_guardian_name', 'Guardian', '');
        $this->form_validation->set_rules('input_guardian_email', 'Guardian Email', 'valid_email');
        $this->form_validation->set_rules('input_guardian_phone', 'Guardian Phone', 'numeric');
        $this->form_validation->set_rules('input_guardian_address', 'Guardian Address', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {

            $studentData = array(
                'id' => trim($this->input->post('hidden_id')),
                'firstname' => trim($this->input->post('input_firstname')),
                'middlename' => trim($this->input->post('input_middlename')),
                'lastname' => trim($this->input->post('input_lastname')),
                'sex' => trim($this->input->post('select_sex')),
                'birthdate' => trim($this->input->post('input_birthdate')),
                'email' => trim($this->input->post('input_email')),
                'cellphone' => trim($this->input->post('input_cellphone')),
                'student_type' => trim($this->input->post('input_student_type')),
                'address' => trim($this->input->post('input_address')),
                'guardian_name' => trim($this->input->post('input_guardian_name')),
                'guardian_email' => trim($this->input->post('input_guardian_email')),
                'guardian_mobile' => trim($this->input->post('input_guardian_mobile')),
                'guardian_address' => trim($this->input->post('input_guardian_address')),
                // 'created_at' => date('Y-m-d h:i:s'),
                // 'updated_at' => date('Y-m-d h:i:s'),
            );

            $this->directory_student->update_student($studentData);

	        $data['response'] = "true";
	        $data['message'] = 'Student Edited!';
        }
	    echo json_encode($data);
    }

    public function search_student()
    {
        $this->form_validation->set_rules('searchItem', 'Searched Item', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('searchItem')) > 0 || !empty(trim($this->input->post('searchItem')))) {
                $data['searched_student'] = $this->directory_student->search_student(trim($this->input->post('searchItem')));
                $data['response'] = 'true';
                $data['message'] = 'Search Student Successful';
                $this->load->view('response/_searched_students', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = '<div class="card-body mt-0 pt-0"><div class="alert alert-warning alert-dismissible"><h5><i class="fa fa-exclamation-triangle"></i> Alert!</h5>Student does not exist.</div></div>';
            }
        }
    }


    public function search_registration_student(){
        $this->form_validation->set_rules('studentLevel', 'Searched Student Level', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $searchStudentLevel = trim($this->input->post('studentLevel'));
            if( $searchStudentLevel > 0 || !empty($searchStudentLevel)) {
                $data['students'] = $this->directory_student->search_student($searchStudentLevel);
                $data['response'] = 'true';
                $data['message'] = 'Search Student Successful';
                $this->load->view('response/_searched_registration_student', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = '<div class="card-body mt-0 pt-0"><div class="alert alert-warning alert-dismissible"><h5><i class="fa fa-exclamation-triangle"></i> Alert!</h5>Student does not exist.</div></div>';
            }
        }
    }

    public function edit_search_registration_student(){
        $this->form_validation->set_rules('studentLevel', 'Searched Student Level', 'trim|required');
        $this->form_validation->set_rules('regStud', 'Searched Student Level', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $searchStudentLevel = trim($this->input->post('studentLevel'));
            $registeredStudent = trim($this->input->post('regStud'));
           
            
            // var_dump($registeredStudent);exit;
            if( $searchStudentLevel > 0 || !empty($searchStudentLevel)) {
                $students = $this->directory_student->search_student($searchStudentLevel);
                if ($registeredStudent == '') {
                    $data['students'] = $students;
                }else{
                    $registeredStudent = explode(',',$registeredStudent);
                    for ($i=0; $i < count($registeredStudent); $i++) { 
                        foreach ($students as $key => $std) {
                            if ($registeredStudent[$i]  == $std['student_number']) {
                                unset($students[$key]);
                            }
                        }
                    }
                    $data['students'] = $students;
                }
                
                $data['response'] = 'true';
                $data['message'] = 'Search Student Successful';
                $this->load->view('response/_edit_searched_registration_student', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = '<div class="card-body mt-0 pt-0"><div class="alert alert-warning alert-dismissible"><h5><i class="fa fa-exclamation-triangle"></i> Alert!</h5>Student does not exist.</div></div>';
            }
        }
    }

    public function search_subject_code(){
        $this->form_validation->set_rules('subjectCode', 'Searched Subject Code', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $searchSubjectCode = trim($this->input->post('subjectCode'));
            if( $searchSubjectCode > 0 || !empty($searchSubjectCode)) {
                $data['searched_subject_code'] = $this->directory_student->search_subject_code($searchSubjectCode);
                $data['response'] = 'true';
                $data['message'] = 'Search Subject Successful';
                $this->load->view('response/_searched_subject_code', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = '<div class="card-body mt-0 pt-0 w-100"><div class="alert alert-warning alert-dismissible"><h5><i class="fa fa-exclamation-triangle"></i> Alert!</h5>Student does not exist.</div></div>';
            }
        }
    }

    public function edit_search_subject_code(){
        $this->form_validation->set_rules('subjectCode', 'Searched Subject Code', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $searchSubjectCode = trim($this->input->post('subjectCode'));
            if( $searchSubjectCode > 0 || !empty($searchSubjectCode)) {
                $data['searched_subject_code'] = $this->directory_student->search_subject_code($searchSubjectCode);
                $data['response'] = 'true';
                $data['message'] = 'Search Subject Successful';
                $this->load->view('response/_edit_searched_subject_code', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = '<div class="card-body mt-0 pt-0 w-100"><div class="alert alert-warning alert-dismissible"><h5><i class="fa fa-exclamation-triangle"></i> Alert!</h5>Student does not exist.</div></div>';
            }
        }
    }


    public function search_block_code(){
        $this->form_validation->set_rules('blockCode', 'Searched Block Code', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $searchBlockCode = trim($this->input->post('blockCode'));
            if( $searchBlockCode > 0 || !empty($searchBlockCode)) {
                $data['searched_subject_code'] = $this->directory_student->search_block_code($searchBlockCode);
                $data['response'] = 'true';
                $data['message'] = 'Search Subject Successful';
                $this->load->view('response/_searched_block_code', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = '<div class="card-body mt-0 pt-0 w-100"><div class="alert alert-warning alert-dismissible"><h5><i class="fa fa-exclamation-triangle"></i> Alert!</h5>Student does not exist.</div></div>';
            }
        }
    }

    public function edit_search_block_code(){
        $this->form_validation->set_rules('blockCode', 'Searched Block Code', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $searchBlockCode = trim($this->input->post('blockCode'));
            if( $searchBlockCode > 0 || !empty($searchBlockCode)) {
                $data['searched_block_code'] = $this->directory_student->search_block_code($searchBlockCode);
                $data['response'] = 'true';
                $data['message'] = 'Search Subject Successful';
                $this->load->view('response/_edit_searched_block_code', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = '<div class="card-body mt-0 pt-0 w-100"><div class="alert alert-warning alert-dismissible"><h5><i class="fa fa-exclamation-triangle"></i> Alert!</h5>Student does not exist.</div></div>';
            }
        }
    }

    public function edit_selected_block_code(){
        $this->form_validation->set_rules('id', 'Selected Block ID', 'required|trim');

        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $blockId = trim($this->input->post('id'));
            // echo json_encode($blockId);exit;
            if( $blockId > 0 || !empty($blockId)) {
                $subjectDetails = $this->directory_student->get_block_subjects($blockId);
                $data['subject_details'] = $subjectDetails;
                $data['student_registered'] = $this->directory_student->get_block_registered_students($blockId);;
                $data['response'] = 'true';
                $data['message'] = 'Getting Subject Successful';
                $this->load->view('response/_edit_selected_block_code', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = '<div class="card-body mt-0 pt-0"><div class="alert alert-warning alert-dismissible"><h5><i class="fa fa-exclamation-triangle"></i> Alert!</h5>Student does not exist.</div></div>';
            }
        }
    }

  



    public function selected_subject_code(){
        $this->form_validation->set_rules('id', 'Selected Subject Code ID', 'numeric|required|trim');

        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $subjId = trim($this->input->post('id'));
            if( $subjId > 0 || !empty($subjId)) {
                $data['subject_code'] = $this->directory_student->get_subject_code_by_id($subjId);
                $data['response'] = 'true';
                $data['message'] = 'Getting Subject Successful';
                $this->load->view('response/_selected_subject_code', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = '<div class="card-body mt-0 pt-0"><div class="alert alert-warning alert-dismissible"><h5><i class="fa fa-exclamation-triangle"></i> Alert!</h5>Student does not exist.</div></div>';
            }
        }
    }

    public function edit_selected_subject_code(){
        $this->form_validation->set_rules('id', 'Selected Subject Code ID', 'required|trim');
        // echo json_encode($this->input->post('id'));exit;
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $subjId = trim($this->input->post('id'));
            
            if( $subjId > 0 || !empty($subjId)) {
                $subjectDetails = $this->directory_student->get_subject_by_subj_code_single($subjId);
              
                $data['subject_details'] = $subjectDetails;
                $data['student_registered'] = $this->directory_student->get_subject_registered_students($subjectDetails['subjectcode']);;
                $data['response'] = 'true';
                $data['message'] = 'Getting Subject Successful';
                $this->load->view('response/_edit_selected_subject_code', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = '<div class="card-body mt-0 pt-0"><div class="alert alert-warning alert-dismissible"><h5><i class="fa fa-exclamation-triangle"></i> Alert!</h5>Student does not exist.</div></div>';
            }
        }
    }

    public function selected_block_code(){
        $this->form_validation->set_rules('id', 'Selected Block Code', 'required|trim');

        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $blockCode = trim($this->input->post('id'));
            if( $blockCode > 0 || !empty($blockCode)) {
                $data['subject_code'] = $this->directory_student->get_block_subjects($blockCode);
                $data['response'] = 'true';
                $data['message'] = 'Getting Subject Successful';
                $this->load->view('response/_selected_block_code', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = '<div class="card-body mt-0 pt-0"><div class="alert alert-warning alert-dismissible"><h5><i class="fa fa-exclamation-triangle"></i> Alert!</h5>Student does not exist.</div></div>';
            }
        }
    }

    public function add_student()
    {
        $this->form_validation->set_rules('input_fname', 'First Name', 'required');
        $this->form_validation->set_rules('input_mname', 'Middle Name', '');
        $this->form_validation->set_rules('input_lname', 'Last Name', 'required');
        $this->form_validation->set_rules('input_student_id', 'Student ID', 'required');
        $this->form_validation->set_rules('select_gender', 'Gender', 'required');
        $this->form_validation->set_rules('input_email', 'Email', 'valid_email');
        $this->form_validation->set_rules('select_school_level', 'School Lvl', 'required');
        $this->form_validation->set_rules('input_address', 'Address', 'required');
        $this->form_validation->set_rules('input_bday', 'Birth Day', 'required');
        $this->form_validation->set_rules('input_phone', 'Phone', 'required|numeric');
        $this->form_validation->set_rules('input_guardian', 'Guardian', 'required');
        $this->form_validation->set_rules('input_gemail', 'Guardian Email', 'valid_email');
        $this->form_validation->set_rules('input_gphone', 'Guardian Phone', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {

            $studentData = array(
                'student_id' => trim($this->input->post('input_student_id')),
                'fname' => trim($this->input->post('input_fname')),
                'mname' => trim($this->input->post('input_mname')),
                'lname' => trim($this->input->post('input_lname')),
                'gender' => trim($this->input->post('select_gender')),
                'bday' => trim($this->input->post('input_bday')),
                'email' => trim($this->input->post('input_email')),
                'phone' => trim($this->input->post('input_phone')),
                'school_lvl' => trim($this->input->post('select_school_level')),
                'address' => trim($this->input->post('input_address')),
                'guardian' => trim($this->input->post('input_guardian')),
                'g_email' => trim($this->input->post('input_gemail')),
                'g_phone' => trim($this->input->post('input_gphone')),
                'created_at' => date('Y-m-d h:i:s'),
            );

            $config = array();
            $config['upload_path'] = './public/uploads/profiles/';
            $config['allowed_types'] = 'gif|jpg|png|tiff|bmp';
            $config['max_size'] = '2048';
            $config['overwrite'] = FALSE;
            $config['detect_mime'] = TRUE;
            $config['mod_mime_fix'] = TRUE;
            $config['remove_spaces'] = TRUE;
            $config['file_ext_tolower'] = TRUE;
            $this->load->library('upload', $config);
            $files = $_FILES;
            if ($files) {
                $_FILES['userfile']['name'] = $files['userfile']['name'];
                $this->upload->initialize($config);
                if (!$this->upload->do_upload())
                {
                    $data['response'] = "false";
                    $data['errors'] = $this->upload->display_errors();
                } else {
                    $udata['upload_data'] = array($this->upload->data());
                    $data_type = $udata['upload_data'];
                    foreach ($data_type as $val)
                    {
                        $file_ext = $val['file_ext'];
                        $orig_file = $val['orig_name'];
                    }
                    $new_name = $studentData['student_id'].'_'.time().'_'.rand(0,100000)."".$file_ext;
                    rename($config['upload_path'].'/'.$orig_file, $config['upload_path'].'/'.$new_name);
                    $studentData['photo'] = trim($new_name);
                }
            }

            $this->directory_student->insert_student($studentData);

	        $data['response'] = "true";
	        $data['message'] = 'Student Added!';
        }
	    echo json_encode($data);
    }


    public function register_student()
    {
        $this->form_validation->set_rules('input_subject_id', 'Subject ID', 'required');
        $this->form_validation->set_rules('chk_students[]', 'Students', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $subjectIds = explode(',',trim($this->input->post('input_subject_id')));

            $students = $this->input->post('chk_students[]');

            $subjectInfo = array();
            if (count($subjectIds) > 1) {
                for ($i=0; $i < count($subjectIds) ; $i++) {

                    $getSubjects = $this->directory_student->get_subject_by_id($subjectIds[$i]);
                    $subjectInfo[] = $getSubjects;
                }
            }else{
                $getSubjects = $this->directory_student->get_subject_by_id($subjectIds[0]);
                $subjectInfo[] = $getSubjects;
            }



            // $data['subjects'] = $subjectInfo[0][0];
            $insertData = array();
            for ($i=0; $i < count($students) ; $i++) {

                // foreach ($subjectInfo as $sbj) {
                //     $insertData[$i]['subjectcode'] = $sbj['subjectcode'];
                //     $insertData[$i]['classcode'] = $sbj['blockclassid'];
                //     $insertData[$i]['subject_name'] = $sbj['subjectname'];
                //     $insertData[$i]['teacher_code'] = $sbj['teacherid'];
                //     $insertData[$i]['section'] = $sbj['section'];
                //     $insertData[$i]['schedule'] = $sbj['schedule'];
                //     $insertData[$i]['adviser_teacher'] = 'TNVAC005';
                //     $insertData[$i]['subject_description'] = $sbj['subjectdesc'];
                // }

                for ($j=0; $j <  count($subjectInfo); $j++) {
                    $insertData[$i][$j]['subjectcode'] = $subjectInfo[$j][0]['subjectcode'];
                    $insertData[$i][$j]['classcode'] = $subjectInfo[$j][0]['blockclassid'];
                    $insertData[$i][$j]['subject_name'] = $subjectInfo[$j][0]['subjectname'];
                    $insertData[$i][$j]['teacher_code'] = $subjectInfo[$j][0]['teacherid'];
                    $insertData[$i][$j]['section'] = $subjectInfo[$j][0]['section'];
                    $insertData[$i][$j]['schedule'] = $subjectInfo[$j][0]['schedule'];
                    $insertData[$i][$j]['adviser_teacher'] = 'TNVAC005';
                    $insertData[$i][$j]['subject_description'] = $subjectInfo[$j][0]['subjectdesc'];
                    $insertData[$i][$j]['student_id'] =  $students[$i];
                }
            }

            $finalInsert = array();
            $subjCount = 0;
            foreach ($insertData as $key => $ins) {

                foreach ($ins as $key1 => $ins1) {
                    // $finalInsert[$subjCount]['subjectcode'] = $ins1['subjectcode'];
                    $finalInsert[$subjCount]['subjectcode'] = $ins1['subjectcode'];
                    $finalInsert[$subjCount]['classcode'] = $ins1['classcode'];
                    $finalInsert[$subjCount]['subject_name'] = $ins1['subject_name'];
                    $finalInsert[$subjCount]['teacher_code'] = $ins1['teacher_code'];
                    $finalInsert[$subjCount]['section'] = $ins1['section'];
                    $finalInsert[$subjCount]['schedule'] = $ins1['schedule'];
                    $finalInsert[$subjCount]['adviser_teacher'] = $ins1['adviser_teacher'];
                    $finalInsert[$subjCount]['subject_description'] = $ins1['subject_description'];
                    $finalInsert[$subjCount]['student_id'] = $ins1['student_id'];
                    $subjCount++;
                }
            }

            // $data['insertData'] = $finalInsert;
            if (!empty($finalInsert)) {
                $this->directory_student->register_student($finalInsert);
                $data['response'] = "true";
	            $data['message'] = 'Student Added!';
            }else{
                $data['response'] = 'false';
                $data['message'] = 'No Insert data';
            }

        }
	    echo json_encode($data);
    }



    public function registration()
	{
        if($this->session->userdata('user_id') != null) {
            $config = array();
            $config['base_url'] = base_url('/directory_student/registration/');
            $config['total_rows'] = $this->directory_student->count_all_subjects();
            $config['per_page'] = 10;
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
            $this->pagination->initialize($config);
            $page = ( $this->uri->segment(3) ) ? $this->uri->segment(3) : 0;
            $data["student_lists"] = $this->directory_student->subject_lists_by_page($config["per_page"], $page);
            // echo "<pre>";
            // print_r($data['student_lists']);exit;
            // echo "</pre>";
            $data["links"] = $this->pagination->create_links();

            $data['title'] = "Student Directory - NVAC Portal";
            $data['module'] = "Student Information";
            $data['function'] = "Student Information";

            $aside = array(
                'menu'  => 'student directory',
                'submenu'     => 'registration',
            );
            $this->session->set_flashdata($aside);

            // $data['classes'] = $this->activities->read_subjects_by_class($this->session->classcode);

            $this->load->view('includes/_wrapper_start');
            $this->load->view('includes/_navbar');
            $this->load->view('includes/_aside');
            $this->load->view('registration_index', $data);
            $this->load->view('includes/_footer');
		    $this->load->view('includes/_wrapper_end');
		} else {
            redirect(base_url(), 'refresh');
		}
    }

    public function import_csv(){
        $data = array();
        $studentData = array();
            $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');
            if($this->form_validation->run() == true){
                $insertCount = $updateCount = $rowCount = $notAddCount = 0;
                 if(is_uploaded_file($_FILES['file']['tmp_name'])){
                     $this->load->library('CSVReader');
                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
                    // $success=array("id" => $csvData,"success"=>true,"message"=>"UPLOAD SUCCESSFUL","file"=>$_FILES['file']['tmp_name']);
                    //         echo json_encode($success);exit;
                    if(!empty($csvData)){
                        foreach($csvData as $row){

                            if ($row['student_number'] == '' ) {
                                continue;
                            }
                            $rowCount++;
                            $studentData['student_number']= $row["student_number"];
                            $studentData['student_type']= $row["student_type"];
                            $studentData['status']=$row["status"];
                            $studentData['grade']=$row["grade"];
                            $studentData['strand']=$row["strand"];
                            $studentData['course']=$row["course"];
                            $studentData['firstname']=$row["firstname"];
                            $studentData['middlename']=$row["middlename"];
                            $studentData['lastname']=$row["lastname"];
                            $studentData['birthdate']=$row["birthdate"];
                            $studentData['sex']=$row["sex"];
                            $studentData['address']=$row["address"];
                            $studentData['cellphone']=$row["cellphone"];
                            $studentData['email']=$row["email"];
                            $studentData['guardian_name']=$row["guardian_name"];
                            $studentData['guardian_mobile']=$row["guardian_mobile"];
                            $studentData['guardian_email']=$row["guardian_email"];
                            $studentData['guardian_address']=$row["guardian_address"];


                            if($this->directory_student->search_student($row["student_number"])){
                                $studentId=$this->directory_student->search_student($row["student_number"]);
                                $studentData['id']=$studentId[0]['id'];

                                 $this->directory_student->update_student($studentData);
                            }
                            else{
                                $this->directory_student->insert_student($studentData);
                            }

                        }
                    }

                }
                $success=array("success"=>true,"message"=>"UPLOAD SUCCESSFUL","file"=>$_FILES['file']['tmp_name']);
                echo json_encode($success);
            }
            else{

                $error=array("error"=>true,"message"=>"Invalid file, please select only CSV file.");
                echo json_encode($error);
            }
    }

    public function import_registration_csv(){
        $data = array();
        $subjectData = array();
            $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');
            if($this->form_validation->run() == true){
                $insertCount = $updateCount = $rowCount = $notAddCount = 0;
                 if(is_uploaded_file($_FILES['file']['tmp_name'])){
                     $this->load->library('CSVReader');
                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);

                    if(!empty($csvData)){
                        foreach($csvData as $row){

                            $rowCount++;
                            $subjectData['subjectcode']= $row["subjectcode"];
                            $subjectData['classcode']= $row["classcode"];
                            $subjectData['subject_name']=$row["subject_name"];
                            $subjectData['teacher_code']=$row["teacher_code"];
                            $subjectData['section']=$row["section"];
                            $subjectData['schedule']=$row["schedule"];
                            $subjectData['adviser_teacher']=$row["adviser_teacher"];
                            $subjectData['student_id']=$row["student_id"];
                            $subjectData['subject_description']=$row["subject_description"];
                            // echo json_encode($studentData);exit;
                            $condition = array(
                                "student_id" => $row['student_id'],
                                "subjectcode" => $row['subjectcode']
                            );

                            if($this->directory_student->search_subject_id($condition)){
                                $subjectId=$this->directory_student->search_subject_id($condition);
                                $subjectData['id']=$subjectId[0]['id'];

                                $this->directory_student->update_subject($subjectData);

                            }
                            else{
                                $this->directory_student->insert_subject($subjectData);
                            }

                        }
                    }

                }
                $success=array("success"=>true,"message"=>"UPLOAD SUCCESSFUL","file"=>$_FILES['file']['tmp_name']);
                echo json_encode($success);
            }
            else{

                $error=array("error"=>true,"message"=>"Invalid file, please select only CSV file.");
                echo json_encode($error);
            }
    }

    public function export_csv(){
        $filename = 'students_'.date('Ymd').'.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
        $studentData = $this->directory_student->get_all_students();
         $file = fopen('php://output', 'w');
         $header = array("student_number","student_type","status","grade","strand","course","firstname","middlename","lastname","birthdate","sex","address","cellphone","email","guardian_name","guardian_mobile","guardian_email","guardian_address");
         fputcsv($file, $header);
         foreach ($studentData as $key=>$line){
             fputcsv($file,$line);
         }
         fclose($file);
         exit;
     }


    function export_registration_csv(){
        $filename = 'subjects_'.date('Ymd').'.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
        $studentData = $this->directory_student->get_all_subjects();
         $file = fopen('php://output', 'w');
         $header = array("subjectcode","classcode","subject_name","teacher_code","section","schedule","adviser_teacher","student_id","subject_description");
         fputcsv($file, $header);
         foreach ($studentData as $key=>$line){
             fputcsv($file,$line);
         }
         fclose($file);
         exit;
    }
    public function file_check($str){
        $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $fileAr = explode('.', $_FILES['file']['name']);
            $ext = end($fileAr);
            if(($ext == 'csv') && in_array($mime, $allowed_mime_types)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }



}
