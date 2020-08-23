<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activities extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('migration_activities', 'activities');
    }

	// public function index()
	// {
    //     if($this->session->userdata('user_id') != null) {
    //         // redirect(base_url('activities'), 'refresh');
    //         $data['title'] = "Activities - NVAC Portal";

    //         $this->load->view('includes/_wrapper_start');
    //         $this->load->view('includes/_navbar');
    //         $this->load->view('includes/_aside');
    //         $this->load->view('activities', $data);
    //         $this->load->view('includes/_footer');
	// 	    $this->load->view('includes/_wrapper_end');
	// 	} else {
    //         redirect(base_url(), 'refresh');
	// 	}
    // }

    public function seatwork()
	{
        // $this->output->enable_profiler(true);
        if($this->session->userdata('user_id') != null) {
            // redirect(base_url('activities'), 'refresh');

            $data['title'] = "Seatworks - NVAC Portal";
            $data['module'] = "Activities";
            $data['function'] = "Seatwork";

            $aside = array(
                'menu'  => 'activities',
                'submenu'     => 'seatwork',
            );
            $this->session->set_flashdata($aside);
            // $userId = $this->session->userdata('user_id');
            $data['seatworklists_q1'] = $this->activities->browse_seatworks('1st quarter');
            $data['seatworklists_q2'] = $this->activities->browse_seatworks('2nd quarter');
            $data['seatworklists_q3'] = $this->activities->browse_seatworks('3rd quarter');
            $data['seatworklists_q4'] = $this->activities->browse_seatworks('4th quarter');
            $data['classes'] = $this->activities->get_all_subject_by_teacher();
            $data['class_by'] = $this->activities->search_class_by_teacher();
            $data['BySubjectCode'] = $this->activities->GetSubject();
            $this->load->view('includes/_wrapper_start');
            $this->load->view('includes/_navbar');
            $this->load->view('includes/_aside');
            $this->load->view('seatwork/seatwork_index', $data);
            $this->load->view('includes/_footer');
		    $this->load->view('includes/_wrapper_end');
		} else {
            redirect(base_url(), 'refresh');
		}
    }

		// public function SeatworkByquarter(){
		// 	$subCategory = array();
		// 	$SubcodeID =  $this->input->post('Subcode');

		// 	$quarter = $this->input->post('quarter');
		// 	if($SubcodeID){
		// 	$con['conditions'] = array('SubcodeID'=>$SubcodeID);
		// 	$subCategory = $this->activities->GetSeatworkBySubjectCode($con,$quarter);
		// }else{
		// 		$data['message'] = "error";
		// }
		// 	echo json_encode($subCategory);
        // }

        public function SeatworkByquarter(){
			// $subCategory = array();
			$SubcodeID =  $this->input->post('Subcode');

			$quarter = $this->input->post('quarter');
			if($SubcodeID){
                $con['conditions'] = array('SubcodeID'=>$SubcodeID);
                $data['BySubjectCode'] = $this->activities->GetSubject();

                if($quarter == '1st quarter'){$sw_sent = 'seatworklists_q1'; $path = 'seatwork/seatwork_sent/quarter1_sw_sent';}
                if($quarter == '2nd quarter'){$sw_sent = 'seatworklists_q2'; $path = 'seatwork/seatwork_sent/quarter2_sw_sent';}
                if($quarter == '3rd quarter'){$sw_sent = 'seatworklists_q3'; $path = 'seatwork/seatwork_sent/quarter3_sw_sent';}
                if($quarter == '4th quarter'){$sw_sent = 'seatworklists_q4'; $path = 'seatwork/seatwork_sent/quarter4_sw_sent';}

                $data[$sw_sent] = $this->activities->GetSeatworkBySubjectCode($con,$quarter);
                $this->load->view($path, $data);

            }else{
                $data['message'] = "error";
            }
			// echo json_encode($subCategory);
		}

    public function create_seatwork()
    {
        $this->form_validation->set_rules('input_seatwork_title', 'Seatwork Title', 'required|numeric');
        $this->form_validation->set_rules('userfile', 'Attach file', 'max_length[255]');
        // $this->form_validation->set_rules('select_options', 'Seatwork Type', 'required');
        $this->form_validation->set_rules('select_term', 'Term', 'required');
        $this->form_validation->set_rules('input_activity_score', 'Points', 'required|numeric');
        $this->form_validation->set_rules('textarea_seatwork', 'Text content', 'required');
        $this->form_validation->set_rules('input_deadline', 'Deadline', 'required');
				// $this->form_validation->set_rules('CheckId', 'Select Subject', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {

        $subjectCode	=	$this->input->post('CheckId');
        $filename	=	$_FILES['userfile']['name'];
        for ($i=0; $i < count($subjectCode) ; $i++) {
            $seatworkData = array(
                'teacher_id' => $this->session->userdata('user_id'),
                'subject_id' => $subjectCode[$i],
                'student_id' => "0",
                'seatwork_title' => 'seatwork '.trim($this->input->post('input_seatwork_title')),
                'editor_content' => trim($this->input->post('textarea_seatwork')),
                'attached_file' => 	 $filename,
                'type' => 'seatwork',
                'term' => trim($this->input->post('select_term')),
                'score' => trim($this->input->post('input_activity_score')),
                'status' => 1,
                'deadline' => trim($this->input->post('input_deadline')),
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            );

            $term = str_replace(' ','',$seatworkData['term']);
            if (!file_exists('./public/uploads/activities/seatworks/'.$term.'/')) {
                    mkdir('./public/uploads/activities/seatworks/'.$term.'/', 0777, true);
            }
            $config = array();
            $config['upload_path'] = './public/uploads/activities/seatworks/'.$term;
            $config['allowed_types'] = 'gif|jpg|png|pdf|docx|xlsx|pptx';
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
                $_FILES['userfile']['type'] = $files['userfile']['type'];
                $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'];
                $_FILES['userfile']['error'] = $files['userfile']['error'];
                $_FILES['userfile']['size'] = $files['userfile']['size'];
                $this->upload->initialize($config);
                if (!$this->upload->do_upload())
                {
                    $data['response'] = "false";
                        $data['errors'] = $this->upload->display_errors();
                } else {
                    $fileName = $_FILES['userfile']['name'];
                    $images[] = $fileName;
                    $udata['upload_data'] = array($this->upload->data());
                    $data_type = $udata['upload_data'];
                    foreach ($data_type as $val)
                    {
                            $file_ext = $val['file_ext'];
                            $orig_file = $val['orig_name'];
                    }
                    $new_name = $term.'_'.time().'_'.rand(0,100000)."".$file_ext;
                    rename($config['upload_path'].'/'.$orig_file, $config['upload_path'].'/'.$new_name);
                    $seatworkData['attached_file'] = trim($new_name);
                }
            }

            $this->activities->create_seatwork($seatworkData);

            $data['response'] = "true";
            $data['message'] = 'Seatwork Created!';
        }

        }
	    echo json_encode($data);
    }

    public function homework()
	{
        if($this->session->userdata('user_id') != null) {
            // redirect(base_url('activities'), 'refresh');
            $data['title'] = "Homeworks - NVAC Portal";
            $data['module'] = "Activities";
            $data['function'] = "Homework";

            $aside = array(
                'menu'  => 'activities',
                'submenu'     => 'homework',
            );
            $this->session->set_flashdata($aside);

            $data['homeworklists_q1'] = $this->activities->browse_homeworks('1st quarter');
            $data['homeworklists_q2'] = $this->activities->browse_homeworks('2nd quarter');
            $data['homeworklists_q3'] = $this->activities->browse_homeworks('3rd quarter');
            $data['homeworklists_q4'] = $this->activities->browse_homeworks('4th quarter');
            $data['classes'] = $this->activities->get_all_subject_by_teacher();
            $data['byClasstable'] = $this->activities->GetHomeworkClass();
            $this->load->view('includes/_wrapper_start');
            $this->load->view('includes/_navbar');
            $this->load->view('includes/_aside');
            $this->load->view('homework/homework_index', $data);
            $this->load->view('includes/_footer');
		    $this->load->view('includes/_wrapper_end');
		} else {
            redirect(base_url(), 'refresh');
		}
    }


		// public function HomeWorkByQuarter(){
		// 	$subCategory = array();
		// 	$SubcodeID =  $this->input->post('Subcode');
		// 	$quarter = $this->input->post('quarter');
		// 	if($SubcodeID){
		// 	$con['conditions'] = array('SubcodeID'=>$SubcodeID);
		// 	$subCategory = $this->activities->GetHomeworkbySubjectCode($con,$quarter);
		// }else{
		// 		$data['message'] = "error";
		// }
		// 	echo json_encode($subCategory);
        // }

        public function HomeWorkByQuarter(){
			// $subCategory = array();
			$SubcodeID =  $this->input->post('Subcode');

			$quarter = $this->input->post('quarter');
			if($SubcodeID){
                $con['conditions'] = array('SubcodeID'=>$SubcodeID);
                // $data['BySubjectCode'] = $this->activities->GetSubject();
                $data['classes'] = $this->activities->get_all_subject_by_teacher();

                if($quarter == '1st quarter'){$hw_sent = 'homeworklists_q1'; $path = 'homework/homework_sent/quarter1_hw_sent';}
                if($quarter == '2nd quarter'){$hw_sent = 'homeworklists_q2'; $path = 'homework/homework_sent/quarter2_hw_sent';}
                if($quarter == '3rd quarter'){$hw_sent = 'homeworklists_q3'; $path = 'homework/homework_sent/quarter3_hw_sent';}
                if($quarter == '4th quarter'){$hw_sent = 'homeworklists_q4'; $path = 'homework/homework_sent/quarter4_hw_sent';}

                $data[$hw_sent] = $this->activities->GetHomeworkbySubjectCode($con,$quarter);
                $this->load->view($path, $data);

            }else{
                $data['message'] = "error";
            }
			// echo json_encode($subCategory);
		}


    public function create_homework()
    {

        $this->form_validation->set_rules('input_homework_title', 'Exam Title', 'required|numeric');
        $this->form_validation->set_rules('userfile', 'Attach file', 'max_length[255]');
        // $this->form_validation->set_rules('select_options', 'Exam Type', 'required');
        $this->form_validation->set_rules('select_term', 'Term', 'required');
        $this->form_validation->set_rules('input_activity_score', 'Points', 'required|numeric');
        $this->form_validation->set_rules('textarea_homework', 'Text content', 'required');
        $this->form_validation->set_rules('input_deadline', 'Deadline', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {

            $fileName = $_FILES['userfile']['name'];
            $subcodeID	=	$this->input->post('checkID');
            for ($i=0; $i < count($subcodeID); $i++) {

                $homeworkData = array(
                    'teacher_id' => $this->session->user_id,
                    'subject_id' => $subcodeID[$i],
                    'student_id' => "0",
                    'homework_title' => 'homework '.trim($this->input->post('input_homework_title')),
                    'editor_content' => trim($this->input->post('textarea_homework')),
                    'attached_file' => $fileName,
                    'type' => 'homework',
                    'term' => trim($this->input->post('select_term')),
                    'score' => trim($this->input->post('input_activity_score')),
                    'status' => 1,
                    'deadline' => trim($this->input->post('input_deadline')),
                    'created_at' => date('Y-m-d h:i:s:A'),
                    'updated_at' => date('Y-m-d h:i:s:A'),
                );

                $term = str_replace(' ','',$homeworkData['term']);
                if (!file_exists('./public/uploads/activities/homeworks/'.$term.'/')) {
                    mkdir('./public/uploads/activities/homeworks/'.$term.'/', 0777, true);
                }

                $config = array();
                $config['upload_path'] = './public/uploads/activities/homeworks/'.$term;
                $config['allowed_types'] = 'gif|jpg|png|pdf|docx|xlsx|pptx';
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
                    $_FILES['userfile']['type'] = $files['userfile']['type'];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'];
                    $_FILES['userfile']['error'] = $files['userfile']['error'];
                    $_FILES['userfile']['size'] = $files['userfile']['size'];
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload())
                    {
                        $data['response'] = "false";
                        $data['errors'] = $this->upload->display_errors();
                    } else {
                        $fileName = $_FILES['userfile']['name'];
                        $images[] = $fileName;
                        $udata['upload_data'] = array($this->upload->data());
                        $data_type = $udata['upload_data'];
                        foreach ($data_type as $val)
                        {
                                $file_ext = $val['file_ext'];
                                $orig_file = $val['orig_name'];
                        }
                        $new_name = $term.'_'.time().'_'.rand(0,100000)."".$file_ext;
                        rename($config['upload_path'].'/'.$orig_file, $config['upload_path'].'/'.$new_name);
                        $homeworkData['attached_file'] = trim($new_name);
                    }
                }

                $this->activities->create_homework($homeworkData);

                $data['response'] = "true";
                $data['message'] = 'Homework Created!';
            }
        }
	    echo json_encode($data);
    }

    public function test_result()
	{
        if($this->session->userdata('user_id') != null) {
            // redirect(base_url('activities'), 'refresh');
            $data['title'] = "Test Result - NVAC Portal";
            $data['module'] = "Activities";
            $data['function'] = "Test Result";
							$userCode =$this->session->userdata('user_id');
            $aside = array(
                'menu'  => 'activities',
                'submenu'     => 'test_result',
            );
            $this->session->set_flashdata($aside);

            $data['all_classes_by_teacher'] = $this->activities->browse_classes_by_teacher($userCode);
            // $data['all_classes_by_teacher'] = $this->activities->browse_classes_by_teacher();

            $this->load->view('includes/_wrapper_start');
            $this->load->view('includes/_navbar');
            $this->load->view('includes/_aside');
            $this->load->view('test_result/test_result_index', $data);
            $this->load->view('includes/_footer');
		    $this->load->view('includes/_wrapper_end');
		} else {
            redirect(base_url(), 'refresh');
		}
    }

    public function search_class_info_q1()
	{
        $this->form_validation->set_rules('classCode', 'Classcode', 'required');
        $this->form_validation->set_rules('testType', 'Test Type', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('classCode')) > 0 || !empty(trim($this->input->post('classCode')))) {
                $data['classcode_info'] = $this->activities->search_classcode_info(trim($this->input->post('classCode')));

                if(trim($this->input->post('testType')) == 'quiz'){
                    $data['students'] = $this->activities->search_class_info_quiz(trim($this->input->post('classCode')), '1st quarter');
                    $data['response'] = 'true';
                    $data['message'] = 'Select class by classcode successful';
                    $this->load->view('test_result/quarter1/search_class_info_quiz_q1', $data);

                }
                if(trim($this->input->post('testType')) == 'exam') {
                    $data['students'] = $this->activities->search_class_info_exam(trim($this->input->post('classCode')), '1st quarter');
                    $data['response'] = 'true';
                    $data['message'] = 'Select class by classcode successful';
                    $this->load->view('test_result/quarter1/search_class_info_exam_q1', $data);

                }
                if(trim($this->input->post('testType')) == 'final exam') {
                    $data['students'] = $this->activities->search_class_info_final_exam(trim($this->input->post('classCode')), '1st quarter');
                    $data['response'] = 'true';
                    $data['message'] = 'Select class by classcode successful';
                    $this->load->view('test_result/quarter1/search_class_info_final_exam_q1', $data);
                }
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No class selected';
            }
        }
    }

    public function search_class_info_q2()
	{
        $this->form_validation->set_rules('classCode', 'Classcode', 'required');
        $this->form_validation->set_rules('testType', 'Test Type', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('classCode')) > 0 || !empty(trim($this->input->post('classCode')))) {
                $data['classcode_info'] = $this->activities->search_classcode_info(trim($this->input->post('classCode')));

                if(trim($this->input->post('testType')) == 'quiz'){
                    $data['students'] = $this->activities->search_class_info_quiz(trim($this->input->post('classCode')), '2nd quarter');
                    $data['response'] = 'true';
                    $data['message'] = 'Select class by classcode successful';
                    $this->load->view('test_result/quarter2/search_class_info_quiz_q2', $data);

                }
                if(trim($this->input->post('testType')) == 'exam') {
                    $data['students'] = $this->activities->search_class_info_exam(trim($this->input->post('classCode')), '2nd quarter');
                    $data['response'] = 'true';
                    $data['message'] = 'Select class by classcode successful';
                    $this->load->view('test_result/quarter2/search_class_info_exam_q2', $data);

                }
                if(trim($this->input->post('testType')) == 'final exam') {
                    $data['students'] = $this->activities->search_class_info_final_exam(trim($this->input->post('classCode')), '2nd quarter');
                    $data['response'] = 'true';
                    $data['message'] = 'Select class by classcode successful';
                    $this->load->view('test_result/quarter2/search_class_info_final_exam_q2', $data);
                }
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No class selected';
            }
        }
    }

    public function search_class_info_q3()
	{
        $this->form_validation->set_rules('classCode', 'Classcode', 'required');
        $this->form_validation->set_rules('testType', 'Test Type', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('classCode')) > 0 || !empty(trim($this->input->post('classCode')))) {
                $data['classcode_info'] = $this->activities->search_classcode_info(trim($this->input->post('classCode')));

                if(trim($this->input->post('testType')) == 'quiz'){
                    $data['students'] = $this->activities->search_class_info_quiz(trim($this->input->post('classCode')), '3rd quarter');
                    $data['response'] = 'true';
                    $data['message'] = 'Select class by classcode successful';
                    $this->load->view('test_result/quarter3/search_class_info_quiz_q3', $data);

                }
                if(trim($this->input->post('testType')) == 'exam') {
                    $data['students'] = $this->activities->search_class_info_exam(trim($this->input->post('classCode')), '3rd quarter');
                    $data['response'] = 'true';
                    $data['message'] = 'Select class by classcode successful';
                    $this->load->view('test_result/quarter3/search_class_info_exam_q3', $data);
                }
                if(trim($this->input->post('testType')) == 'final exam') {
                    $data['students'] = $this->activities->search_class_info_final_exam(trim($this->input->post('classCode')), '3rd quarter');
                    $data['response'] = 'true';
                    $data['message'] = 'Select class by classcode successful';
                    $this->load->view('test_result/quarter3/search_class_info_final_exam_q3', $data);
                }
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No class selected';
            }
        }
    }

    public function search_class_info_q4()
	{
        $this->form_validation->set_rules('classCode', 'Classcode', 'required');
        $this->form_validation->set_rules('testType', 'Test Type', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('classCode')) > 0 || !empty(trim($this->input->post('classCode')))) {
                $data['classcode_info'] = $this->activities->search_classcode_info(trim($this->input->post('classCode')));

                if(trim($this->input->post('testType')) == 'quiz'){
                    $data['students'] = $this->activities->search_class_info_quiz(trim($this->input->post('classCode')), '4th quarter');
                    $data['response'] = 'true';
                    $data['message'] = 'Select class by classcode successful';
                    $this->load->view('test_result/quarter4/search_class_info_quiz_q4', $data);

                }
                if(trim($this->input->post('testType')) == 'exam') {
                    $data['students'] = $this->activities->search_class_info_exam(trim($this->input->post('classCode')), '4th quarter');
                    $data['response'] = 'true';
                    $data['message'] = 'Select class by classcode successful';
                    $this->load->view('test_result/quarter4/search_class_info_exam_q4', $data);

                }
                if(trim($this->input->post('testType')) == 'final exam') {
                    $data['students'] = $this->activities->search_class_info_final_exam(trim($this->input->post('classCode')), '4th quarter');
                    $data['response'] = 'true';
                    $data['message'] = 'Select class by classcode successful';
                    $this->load->view('test_result/quarter4/search_class_info_final_exam_q4', $data);
                }
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No class selected';
            }
        }
    }

    public function search_student()
    {
        $this->form_validation->set_rules('searchItem', 'Student Name', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('searchItem')) > 0 || !empty(trim($this->input->post('searchItem')))) {
                $data['searched_student'] = $this->activities->search_student(trim($this->input->post('searchItem')));
                $data['response'] = 'true';
                $data['message'] = 'Read Student Successful';
                $this->load->view('seatwork/response/searched_table_individual', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = '<div class="card-body mt-0 pt-0"><div class="alert alert-warning alert-dismissible"><h5><i class="fa fa-exclamation-triangle"></i> Alert!</h5>Student does not exist.</div></div>';
            }
        }
    }

    public function search_student_create_group()
    {
        $this->form_validation->set_rules('searchItem', 'Student Name', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('searchItem')) > 0 || !empty(trim($this->input->post('searchItem')))) {
                $data['searched_student'] = $this->activities->search_student(trim($this->input->post('searchItem')));
                $data['response'] = 'true';
                $data['message'] = 'Read Student Successful';
                $this->load->view('seatwork/response/searched_table_create_group', $data);
                $this->load->view('homework/response/searched_table_create_group', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = '<div class="card-body mt-0 pt-0"><div class="alert alert-warning alert-dismissible"><h5><i class="fa fa-exclamation-triangle"></i> Alert!</h5>Student does not exist.</div></div>';
            }
        }
    }

    public function search_class_sw()
    {
        $this->form_validation->set_rules('searchItem', 'Student Name', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('searchItem')) > 0 || !empty(trim($this->input->post('searchItem')))) {
                $data['searched_classes'] = $this->activities->search_class(trim($this->input->post('searchItem')));
                $data['response'] = 'true';
                $data['message'] = 'Read Student Successful';
                $this->load->view('seatwork/response/searched_table_class', $data);
                // $this->load->view('homework/response/searched_table_class', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = '<div class="card-body mt-0 pt-0"><div class="alert alert-warning alert-dismissible"><h5><i class="fa fa-exclamation-triangle"></i> Alert!</h5>Student does not exist.</div></div>';
            }
        }
    }

    public function search_class_hw()
    {
        $this->form_validation->set_rules('searchItem', 'Student Name', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('searchItem')) > 0 || !empty(trim($this->input->post('searchItem')))) {
                $data['searched_classes'] = $this->activities->search_class(trim($this->input->post('searchItem')));
                $data['response'] = 'true';
                $data['message'] = 'Read Student Successful';
                // $this->load->view('seatwork/response/searched_table_class', $data);
                $this->load->view('homework/response/searched_table_class', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = '<div class="card-body mt-0 pt-0"><div class="alert alert-warning alert-dismissible"><h5><i class="fa fa-exclamation-triangle"></i> Alert!</h5>Student does not exist.</div></div>';
            }
        }
    }

    public function bulk_seatwork_send()
    {
        $this->form_validation->set_rules('toBulkRegister[]', 'Check Box', 'required');
        $this->form_validation->set_rules('bulk_reg_select_class_code[]', 'Class Code', 'required');
        $this->form_validation->set_rules('toBulkRegister_admission_id[]', 'Admission ID', 'required');
        $this->form_validation->set_rules('toBulkRegister_email[]', 'Email', 'required');
        $this->form_validation->set_rules('hidden_student_id[]', 'Student/Admission ID', 'required');

        $this->form_validation->set_rules('input_seatwork_title', 'Exam Title', 'required|numeric');
        $this->form_validation->set_rules('userfile', 'Attach file', 'max_length[255]');
        $this->form_validation->set_rules('select_options', 'Exam Type', 'required');
        $this->form_validation->set_rules('select_term', 'Term', 'required');
        $this->form_validation->set_rules('input_activity_score', 'Points', 'required|numeric');
        $this->form_validation->set_rules('textarea_seatwork', 'Text content', 'required');
        $this->form_validation->set_rules('input_deadline', 'Deadline', 'required');

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

                $seatworkData = array(
                    'teacher_id' => $this->session->teacher_id,
                    'subject_id' => trim($this->input->post('hidden_subject_id')),
                    'student_id' => trim($this->input->post('hidden_student_id')),
                    'seatwork_title' => 'seatwork '.trim($this->input->post('input_seatwork_title')),
                    'editor_content' => trim($this->input->post('textarea_seatwork')),
                    // 'attached_file' => trim($this->input->post('userfile')),
                    'type' => 'seatwork',
                    'term' => trim($this->input->post('select_term')),
                    'score' => trim($this->input->post('input_activity_score')),
                    'status' => 1,
                    'deadline' => trim($this->input->post('input_deadline')),
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s'),
                );

                $term = str_replace(' ','',$seatworkData['term']);
                if (!file_exists('./public/uploads/activities/seatworks/'.$term.'/')) {
                    mkdir('./public/uploads/activities/seatworks/'.$term.'/', 0777, true);
                }

                $config = array();
                $config['upload_path'] = './public/uploads/activities/seatworks/'.$term;
                $config['allowed_types'] = 'gif|jpg|png|pdf|docx|xlsx|pptx';
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
                    $_FILES['userfile']['type'] = $files['userfile']['type'];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'];
                    $_FILES['userfile']['error'] = $files['userfile']['error'];
                    $_FILES['userfile']['size'] = $files['userfile']['size'];
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload())
                    {
                        $data['response'] = "false";
                        $data['errors'] = $this->upload->display_errors();
                    } else {
                        $fileName = $_FILES['userfile']['name'];
                        $images[] = $fileName;
                        $udata['upload_data'] = array($this->upload->data());
                        $data_type = $udata['upload_data'];
                        foreach ($data_type as $val)
                        {
                            $file_ext = $val['file_ext'];
                            $orig_file = $val['orig_name'];
                        }
                        $new_name = $term.'_'.time().'_'.rand(0,100000)."".$file_ext;
                        rename($config['upload_path'].'/'.$orig_file, $config['upload_path'].'/'.$new_name);
                        $seatworkData['attached_file'] = trim($new_name);
                    }

                    // $this->email->from('nvac.edu.ph', 'NVAC');
                    // $this->email->to($_POST['toBulkRegister_email'][$i]);
                    // $this->email->subject('NVAC LMS Login Credentials');
                    // $this->email->message('hello');

                    // $this->email->send();

                    $this->admissions->create_seatwork($seatworkData);
                }

                $data['response'] = 'true';
                $data['message'] = 'Register Successful';

            }
            echo json_encode($data);
        }
    }

    public function bulk_homework_send()
    {
        $this->form_validation->set_rules('toBulkRegister[]', 'Check Box', 'required');
        $this->form_validation->set_rules('bulk_reg_select_class_code[]', 'Class Code', 'required');
        $this->form_validation->set_rules('toBulkRegister_admission_id[]', 'Admission ID', 'required');
        $this->form_validation->set_rules('toBulkRegister_email[]', 'Email', 'required');
        $this->form_validation->set_rules('hidden_student_id[]', 'Student/Admission ID', 'required');

        $this->form_validation->set_rules('input_homework_title', 'Exam Title', 'required|numeric');
        $this->form_validation->set_rules('userfile', 'Attach file', 'max_length[255]');
        $this->form_validation->set_rules('select_options', 'Exam Type', 'required');
        $this->form_validation->set_rules('select_term', 'Term', 'required');
        $this->form_validation->set_rules('input_activity_score', 'Points', 'required|numeric');
        $this->form_validation->set_rules('textarea_homework', 'Text content', 'required');
        $this->form_validation->set_rules('input_deadline', 'Deadline', 'required');

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

                $homeworkData = array(
                    'teacher_id' => $this->session->teacher_id,
                    'subject_id' => trim($this->input->post('hidden_subject_id')),
                    'student_id' => trim($this->input->post('hidden_student_id')),
                    'homework_title' => 'homework '.trim($this->input->post('input_homework_title')),
                    'editor_content' => trim($this->input->post('textarea_homework')),
                    // 'attached_file' => trim($this->input->post('userfile')),
                    'type' => 'homework',
                    'term' => trim($this->input->post('select_term')),
                    'score' => trim($this->input->post('input_activity_score')),
                    'status' => 1,
                    'deadline' => trim($this->input->post('input_deadline')),
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s'),
                );

                $term = str_replace(' ','',$homeworkData['term']);
                if (!file_exists('./public/uploads/activities/homeworks/'.$term.'/')) {
                    mkdir('./public/uploads/activities/homeworks/'.$term.'/', 0777, true);
                }

                $config = array();
                $config['upload_path'] = './public/uploads/activities/homeworks/'.$term;
                $config['allowed_types'] = 'gif|jpg|png|pdf|docx|xlsx|pptx';
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
                    $_FILES['userfile']['type'] = $files['userfile']['type'];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'];
                    $_FILES['userfile']['error'] = $files['userfile']['error'];
                    $_FILES['userfile']['size'] = $files['userfile']['size'];
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload())
                    {
                        $data['response'] = "false";
                        $data['errors'] = $this->upload->display_errors();
                    } else {
                        $fileName = $_FILES['userfile']['name'];
                        $images[] = $fileName;
                        $udata['upload_data'] = array($this->upload->data());
                        $data_type = $udata['upload_data'];
                        foreach ($data_type as $val)
                        {
                            $file_ext = $val['file_ext'];
                            $orig_file = $val['orig_name'];
                        }
                        $new_name = $term.'_'.time().'_'.rand(0,100000)."".$file_ext;
                        rename($config['upload_path'].'/'.$orig_file, $config['upload_path'].'/'.$new_name);
                        $homeworkData['attached_file'] = trim($new_name);
                    }

                    // $this->email->from('nvac.edu.ph', 'NVAC');
                    // $this->email->to($_POST['toBulkRegister_email'][$i]);
                    // $this->email->subject('NVAC LMS Login Credentials');
                    // $this->email->message('hello');

                    // $this->email->send();

                    $this->admissions->create_homework($homeworkData);
                }

                $data['response'] = 'true';
                $data['message'] = 'Register Successful';

            }
            echo json_encode($data);
        }
    }

    public function bulk_seatwork_send_class()
    {

        $this->form_validation->set_rules('toBulkRegister[]', 'Check Box', 'required');
        $this->form_validation->set_rules('bulk_reg_select_class_code[]', 'Class Code', 'required');
        $this->form_validation->set_rules('toBulkRegister_admission_id[]', 'Admission ID', 'required');
        $this->form_validation->set_rules('toBulkRegister_email[]', 'Email', 'required');
        $this->form_validation->set_rules('hidden_subject_id', 'Subject ID', 'required');

        $this->form_validation->set_rules('input_seatwork_title', 'Exam Title', 'required|numeric');
        $this->form_validation->set_rules('userfile', 'Attach file', 'max_length[255]');
        $this->form_validation->set_rules('select_options', 'Exam Type', 'required');
        $this->form_validation->set_rules('select_term', 'Term', 'required');
        $this->form_validation->set_rules('input_activity_score', 'Points', 'required|numeric');
        $this->form_validation->set_rules('textarea_seatwork', 'Text content', 'required');
        $this->form_validation->set_rules('input_deadline', 'Deadline', 'required');

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

                $seatworkData = array(
                    'teacher_id' => $this->session->teacher_id,
                    'subject_id' => trim($this->input->post('hidden_subject_id')),
                    'student_id' => trim($this->input->post('hidden_student_id')),
                    'seatwork_title' => 'seatwork '.trim($this->input->post('input_seatwork_title')),
                    'editor_content' => trim($this->input->post('textarea_seatwork')),
                    // 'attached_file' => trim($this->input->post('userfile')),
                    'type' => 'seatwork',
                    'term' => trim($this->input->post('select_term')),
                    'score' => trim($this->input->post('input_activity_score')),
                    'status' => 1,
                    'deadline' => trim($this->input->post('input_deadline')),
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s'),
                );

                $term = str_replace(' ','',$seatworkData['term']);
                if (!file_exists('./public/uploads/activities/seatworks/'.$term.'/')) {
                    mkdir('./public/uploads/activities/seatworks/'.$term.'/', 0777, true);
                }

                $config = array();
                $config['upload_path'] = './public/uploads/activities/seatworks/'.$term;
                $config['allowed_types'] = 'gif|jpg|png|pdf|docx|xlsx|pptx';
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
                    $_FILES['userfile']['type'] = $files['userfile']['type'];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'];
                    $_FILES['userfile']['error'] = $files['userfile']['error'];
                    $_FILES['userfile']['size'] = $files['userfile']['size'];
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload())
                    {
                        $data['response'] = "false";
                        $data['errors'] = $this->upload->display_errors();
                    } else {
                        $fileName = $_FILES['userfile']['name'];
                        $images[] = $fileName;
                        $udata['upload_data'] = array($this->upload->data());
                        $data_type = $udata['upload_data'];
                        foreach ($data_type as $val)
                        {
                            $file_ext = $val['file_ext'];
                            $orig_file = $val['orig_name'];
                        }
                        $new_name = $term.'_'.time().'_'.rand(0,100000)."".$file_ext;
                        rename($config['upload_path'].'/'.$orig_file, $config['upload_path'].'/'.$new_name);
                        $seatworkData['attached_file'] = trim($new_name);
                    }

                    // $this->email->from('nvac.edu.ph', 'NVAC');
                    // $this->email->to($_POST['toBulkRegister_email'][$i]);
                    // $this->email->subject('NVAC LMS Login Credentials');
                    // $this->email->message('hello');

                    // $this->email->send();

                    $this->admissions->create_seatwork($seatworkData);
                }

                $data['response'] = 'true';
                $data['message'] = 'Register Successful';

            }
            echo json_encode($data);
        }
    }

    public function bulk_homework_send_class()
    {

        $this->form_validation->set_rules('toBulkRegister[]', 'Check Box', 'required');
        $this->form_validation->set_rules('bulk_reg_select_class_code[]', 'Class Code', 'required');
        $this->form_validation->set_rules('toBulkRegister_admission_id[]', 'Admission ID', 'required');
        $this->form_validation->set_rules('toBulkRegister_email[]', 'Email', 'required');
        $this->form_validation->set_rules('hidden_subject_id', 'Subject ID', 'required');

        $this->form_validation->set_rules('input_homework_title', 'Exam Title', 'required|numeric');
        $this->form_validation->set_rules('userfile', 'Attach file', 'max_length[255]');
        $this->form_validation->set_rules('select_options', 'Exam Type', 'required');
        $this->form_validation->set_rules('select_term', 'Term', 'required');
        $this->form_validation->set_rules('input_activity_score', 'Points', 'required|numeric');
        $this->form_validation->set_rules('textarea_homework', 'Text content', 'required');
        $this->form_validation->set_rules('input_deadline', 'Deadline', 'required');

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

                $homeworkData = array(
                    'teacher_id' => $this->session->teacher_id,
                    'subject_id' => trim($this->input->post('hidden_subject_id')),
                    'student_id' => trim($this->input->post('hidden_student_id')),
                    'homework_title' => 'homework '.trim($this->input->post('input_homework_title')),
                    'editor_content' => trim($this->input->post('textarea_homework')),
                    // 'attached_file' => trim($this->input->post('userfile')),
                    'type' => 'homework',
                    'term' => trim($this->input->post('select_term')),
                    'score' => trim($this->input->post('input_activity_score')),
                    'status' => 1,
                    'deadline' => trim($this->input->post('input_deadline')),
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s'),
                );

                $term = str_replace(' ','',$homeworkData['term']);
                if (!file_exists('./public/uploads/activities/homeworks/'.$term.'/')) {
                    mkdir('./public/uploads/activities/homeworks/'.$term.'/', 0777, true);
                }

                $config = array();
                $config['upload_path'] = './public/uploads/activities/homeworks/'.$term;
                $config['allowed_types'] = 'gif|jpg|png|pdf|docx|xlsx|pptx';
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
                    $_FILES['userfile']['type'] = $files['userfile']['type'];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'];
                    $_FILES['userfile']['error'] = $files['userfile']['error'];
                    $_FILES['userfile']['size'] = $files['userfile']['size'];
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload())
                    {
                        $data['response'] = "false";
                        $data['errors'] = $this->upload->display_errors();
                    } else {
                        $fileName = $_FILES['userfile']['name'];
                        $images[] = $fileName;
                        $udata['upload_data'] = array($this->upload->data());
                        $data_type = $udata['upload_data'];
                        foreach ($data_type as $val)
                        {
                            $file_ext = $val['file_ext'];
                            $orig_file = $val['orig_name'];
                        }
                        $new_name = $term.'_'.time().'_'.rand(0,100000)."".$file_ext;
                        rename($config['upload_path'].'/'.$orig_file, $config['upload_path'].'/'.$new_name);
                        $homeworkData['attached_file'] = trim($new_name);
                    }

                    // $this->email->from('nvac.edu.ph', 'NVAC');
                    // $this->email->to($_POST['toBulkRegister_email'][$i]);
                    // $this->email->subject('NVAC LMS Login Credentials');
                    // $this->email->message('hello');

                    // $this->email->send();

                    $this->admissions->create_homework($homeworkData);
                }

                $data['response'] = 'true';
                $data['message'] = 'Register Successful';

            }
            echo json_encode($data);
        }
    }

    public function search_student_by_teacher_sw()
	{
        $this->form_validation->set_rules('teacherCode', 'Option', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('teacherCode')) > 0 || !empty(trim($this->input->post('teacherCode')))) {

                $data['students_by'] = $this->activities->search_student_by_teacher(trim($this->input->post('teacherCode')));
                $data['response'] = 'true';
                $data['message'] = 'Read Student Successful';
                $this->load->view('seatwork/modals/modal_create_group', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No class selected';
            }
        }
    }

    public function search_student_by_teacher_hw()
	{
        $this->form_validation->set_rules('teacherCode', 'Option', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('teacherCode')) > 0 || !empty(trim($this->input->post('teacherCode')))) {

                $data['students_by'] = $this->activities->search_student_by_teacher(trim($this->input->post('teacherCode')));
                $data['response'] = 'true';
                $data['message'] = 'Read Student Successful';
                $this->load->view('homework/modals/modal_create_group', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No class selected';
            }
        }
    }

    public function search_class_by_teacher_sw()
	{
        $this->form_validation->set_rules('teacherCode', 'Option', 'required');
							$userId = $this->session->userdata('user_id');


        if ($this->form_validation->run() == FALSE){
            // $data['response'] = "false";
            // $data['message'] = validation_errors();

        } else {

            if( trim($this->input->post('teacherCode')) > 0 || !empty(trim($this->input->post('teacherCode')))) {

                $data['class_by'] = $this->activities->search_class_by_teacher(trim($this->input->post('teacherCode')));

                $data['response'] = 'true';
                $data['message'] = 'Read Student Successful';
                $this->load->view('seatwork/modals/modal_class', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No class selected';
            }
        }
    }

    public function search_class_by_teacher_hw()
	{
        $this->form_validation->set_rules('teacherCode', 'Option', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('teacherCode')) > 0 || !empty(trim($this->input->post('teacherCode')))) {

                // $data['class_by'] = $this->activities->search_class_by_teacher(trim($this->input->post('teacherCode')));

                $data['response'] = 'true';
                $data['message'] = 'Read Student Successful';
                $this->load->view('homework/modals/modal_class', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No class selected';
            }
        }
    }

    public function delete_seatwork()
    {
        $this->form_validation->set_rules('seatwork_id', 'Seawork ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('seatwork_id')) > 0 || !empty(trim($this->input->post('seatwork_id')))) {
                $data['seatworks'] = $this->activities->delete_seatwork(trim($this->input->post('seatwork_id')));
                $data['response'] = 'true';
                $data['message'] = 'Seatwork Deleted';
                $this->load->view('seatwork/seatwork_index', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No seatwork selected';
            }
        }
    }

    public function delete_homework()
    {
        $this->form_validation->set_rules('homework_id', 'Homework ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('homework_id')) > 0 || !empty(trim($this->input->post('homework_id')))) {
                $data['homeworks'] = $this->activities->delete_homework(trim($this->input->post('homework_id')));
                $data['response'] = 'true';
                $data['message'] = 'Homework Deleted';
                $this->load->view('homework/homework_index', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No homework selected';
            }
        }
    }

    public function edit_seatwork()
    {
        $this->form_validation->set_rules('seatwork_id', 'Seatwork ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('seatwork_id')) > 0 || !empty(trim($this->input->post('seatwork_id')))) {
                $data['seatwork_details'] = $this->activities->browse_seatwork_by_id(trim($this->input->post('seatwork_id')));
                $data['response'] = 'true';
                $data['message'] = 'Seatwork Deleted';
                $this->load->view('seatwork/response/searched_seatworks', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No seatwork selected';
            }
        }
    }

    public function edit_homework()
    {
        $this->form_validation->set_rules('homework_id', 'Homework ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('homework_id')) > 0 || !empty(trim($this->input->post('homework_id')))) {
                $data['homework_details'] = $this->activities->browse_homework_by_id(trim($this->input->post('homework_id')));
                $data['response'] = 'true';
                $data['message'] = 'Homework Deleted';
                $this->load->view('homework/response/searched_homeworks', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No seatwork selected';
            }
        }
    }

    public function insert_edit_seatwork()
    {

        $this->form_validation->set_rules('hidden_seatwork_id', 'Seatwork id', 'required');
        $this->form_validation->set_rules('input_seatwork_title', 'Seatwork Title', 'required|numeric');
        // $this->form_validation->set_rules('userfile', 'Attach file', 'max_length[255]');
        // $this->form_validation->set_rules('select_options', 'Seatwork Type', 'required');
        $this->form_validation->set_rules('select_term', 'Term', 'required');
        $this->form_validation->set_rules('input_activity_score', 'Points', 'required|numeric');
        $this->form_validation->set_rules('textarea_seatwork', 'Text content', 'required');
        $this->form_validation->set_rules('input_deadline', 'Deadline', 'required');
        $this->form_validation->set_rules('hidden_subject_id_sw', 'Subject ID', '');
        $this->form_validation->set_rules('hidden_student_id_sw', 'Student ID', '');

        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {

            $seatworkData = array(
                'seatwork_id' => trim($this->input->post('hidden_seatwork_id')),
                'teacher_id' => $this->session->teacher_id,
                'subject_id' => trim($this->input->post('hidden_subject_id_sw')),
                'student_id' => trim($this->input->post('hidden_student_id_sw')),
                'seatwork_title' => 'seatwork '.trim($this->input->post('input_seatwork_title')),
                'editor_content' => trim($this->input->post('textarea_seatwork')),
                // 'attached_file' => trim($this->input->post('userfile')),
                'type' => 'seatwork',
                'term' => trim($this->input->post('select_term')),
                'score' => trim($this->input->post('input_activity_score')),
                'status' => 1,
                'deadline' => trim($this->input->post('input_deadline')),
                // 'created_at' => date('Y-m-d h:i:s'),
                // 'updated_at' => date('Y-m-d h:i:s'),
            );

            // $term = str_replace(' ','',$seatworkData['term']);
            // if (!file_exists('./public/uploads/activities/seatworks/'.$term.'/')) {
            //     mkdir('./public/uploads/activities/seatworks/'.$term.'/', 0777, true);
            // }
            //     $config = array();
            //     $config['upload_path'] = './public/uploads/activities/seatworks/'.$term;
            //     $config['allowed_types'] = 'gif|jpg|png|pdf|docx|xlsx|pptx';
            //     $config['max_size'] = '2048';
            //     $config['overwrite'] = FALSE;
            //     $config['detect_mime'] = TRUE;
            //     $config['mod_mime_fix'] = TRUE;
            //     $config['remove_spaces'] = TRUE;
            //     $config['file_ext_tolower'] = TRUE;
            //     $this->load->library('upload', $config);
            //     $files = $_FILES;
            //     if ($files) {
            //         $_FILES['userfile']['name'] = $files['userfile']['name'];
            //         $_FILES['userfile']['type'] = $files['userfile']['type'];
            //         $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'];
            //         $_FILES['userfile']['error'] = $files['userfile']['error'];
            //         $_FILES['userfile']['size'] = $files['userfile']['size'];
            //         $this->upload->initialize($config);
            //         if (!$this->upload->do_upload())
            //         {
            //             $data['response'] = "false";
            //             $data['errors'] = $this->upload->display_errors();
            //         } else {
            //             $fileName = $_FILES['userfile']['name'];
            //             $images[] = $fileName;
            //             $udata['upload_data'] = array($this->upload->data());
            //             $data_type = $udata['upload_data'];
            //             foreach ($data_type as $val)
            //             {
            //                 $file_ext = $val['file_ext'];
            //                 $orig_file = $val['orig_name'];
            //             }
            //             $new_name = $term.'_'.time().'_'.rand(0,100000)."".$file_ext;
            //             rename($config['upload_path'].'/'.$orig_file, $config['upload_path'].'/'.$new_name);
            //             $seatworkData['attached_file'] = trim($new_name);
            //         }
            //     }

            $this->activities->update_seatwork($seatworkData);

	        $data['response'] = "true";
	        $data['message'] = 'Seatwork Created!';
        }
	    echo json_encode($data);
    }

    public function insert_edit_homework()
    {

        $this->form_validation->set_rules('hidden_homework_id', 'Homework id', 'required');
        $this->form_validation->set_rules('input_homework_title', 'Homework Title', 'required|numeric');
        // $this->form_validation->set_rules('userfile', 'Attach file', 'max_length[255]');
        // $this->form_validation->set_rules('select_options', 'Homework Type', 'required');
        $this->form_validation->set_rules('select_term_hw', 'Term', 'required');
        $this->form_validation->set_rules('input_activity_score_hw', 'Points', 'required|numeric');
        $this->form_validation->set_rules('textarea_homework', 'Text content', 'required');
        $this->form_validation->set_rules('input_deadline_hw', 'Deadline', 'required');
        $this->form_validation->set_rules('hidden_subject_id_hw', 'Subject ID', '');
        $this->form_validation->set_rules('hidden_student_id_hw', 'Student ID', '');

        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {

            $homeworkData = array(
                'homework_id' => trim($this->input->post('hidden_homework_id')),
                'teacher_id' => $this->session->teacher_id,
                'subject_id' => trim($this->input->post('hidden_subject_id_hw')),
                'student_id' => trim($this->input->post('hidden_student_id_hw')),
                'homework_title' => 'homework '.trim($this->input->post('input_homework_title')),
                'editor_content' => trim($this->input->post('textarea_homework')),
                // 'attached_file' => trim($this->input->post('userfile')),
                'type' => 'homework',
                'term' => trim($this->input->post('select_term_hw')),
                'score' => trim($this->input->post('input_activity_score_hw')),
                'status' => 1,
                'deadline' => trim($this->input->post('input_deadline_hw')),
                // 'created_at' => date('Y-m-d h:i:s'),
                // 'updated_at' => date('Y-m-d h:i:s'),
            );

            // $term = str_replace(' ','',$homeworkData['term']);
            // if (!file_exists('./public/uploads/activities/homeworks/'.$term.'/')) {
            //     mkdir('./public/uploads/activities/homeworks/'.$term.'/', 0777, true);
            // }
            //     $config = array();
            //     $config['upload_path'] = './public/uploads/activities/homeworks/'.$term;
            //     $config['allowed_types'] = 'gif|jpg|png|pdf|docx|xlsx|pptx';
            //     $config['max_size'] = '2048';
            //     $config['overwrite'] = FALSE;
            //     $config['detect_mime'] = TRUE;
            //     $config['mod_mime_fix'] = TRUE;
            //     $config['remove_spaces'] = TRUE;
            //     $config['file_ext_tolower'] = TRUE;
            //     $this->load->library('upload', $config);
            //     $files = $_FILES;
            //     if ($files) {
            //         $_FILES['userfile']['name'] = $files['userfile']['name'];
            //         $_FILES['userfile']['type'] = $files['userfile']['type'];
            //         $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'];
            //         $_FILES['userfile']['error'] = $files['userfile']['error'];
            //         $_FILES['userfile']['size'] = $files['userfile']['size'];
            //         $this->upload->initialize($config);
            //         if (!$this->upload->do_upload())
            //         {
            //             $data['response'] = "false";
            //             $data['errors'] = $this->upload->display_errors();
            //         } else {
            //             $fileName = $_FILES['userfile']['name'];
            //             $images[] = $fileName;
            //             $udata['upload_data'] = array($this->upload->data());
            //             $data_type = $udata['upload_data'];
            //             foreach ($data_type as $val)
            //             {
            //                 $file_ext = $val['file_ext'];
            //                 $orig_file = $val['orig_name'];
            //             }
            //             $new_name = $term.'_'.time().'_'.rand(0,100000)."".$file_ext;
            //             rename($config['upload_path'].'/'.$orig_file, $config['upload_path'].'/'.$new_name);
            //             $homeworkData['attached_file'] = trim($new_name);
            //         }
            //     }

            $this->activities->update_homework($homeworkData);

	        $data['response'] = "true";
	        $data['message'] = 'homework Created!';
        }
	    echo json_encode($data);
    }

    public function toggle_publish_quiz()
    {
        $this->form_validation->set_rules('is_published', 'Publish', 'required');
        $this->form_validation->set_rules('quiz_result_id', 'Quiz Result ID', 'required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if(!empty(trim($this->input->post('quiz_result_id')))) {
                $data['publish_status'] = $this->activities->toggle_publish_quiz(trim($this->input->post('is_published')), trim($this->input->post('quiz_result_id')));
                $data['response'] = 'true';
                $data['message'] = 'Quiz Publish Status Updated';
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Quiz Publish Status Updated';
            }
        }
        echo json_encode($data);
    }

    public function toggle_publish_exam()
    {
        $this->form_validation->set_rules('is_published', 'Publish', 'required');
        $this->form_validation->set_rules('exam_result_id', 'Exam Result ID', 'required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if(!empty(trim($this->input->post('exam_result_id')))) {
                $data['publish_status'] = $this->activities->toggle_publish_exam(trim($this->input->post('is_published')), trim($this->input->post('exam_result_id')));
                $data['response'] = 'true';
                $data['message'] = 'Exam Publish Status Updated';
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Exam Publish Status Updated';
            }
        }
        echo json_encode($data);
    }

    public function toggle_publish_final_exam()
    {
        $this->form_validation->set_rules('is_published', 'Publish', 'required');
        $this->form_validation->set_rules('final_result_id', 'Final Exam Result ID', 'required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if(!empty(trim($this->input->post('final_result_id')))) {
                $data['publish_status'] = $this->activities->toggle_publish_final_exam(trim($this->input->post('is_published')), trim($this->input->post('final_result_id')));
                $data['response'] = 'true';
                $data['message'] = 'Final Exam Publish Status Updated';
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Final Exam Publish Status Updated';
            }
        }
        echo json_encode($data);
    }




    public function seatwork_stud()
	{
        if($this->session->userdata('user_id') != null) {
            // redirect(base_url('activities'), 'refresh');
            $data['title'] = "Seatworks - NVAC Portal";
            $data['module'] = "Activities";
            $data['function'] = "Seatwork";

            $aside = array(
                'menu'  => 'activities',
                'submenu'     => 'seatwork',
            );
            $this->session->set_flashdata($aside);

            $data['classes'] = $this->activities->read_subjects_by_class();

            $this->load->view('includes/_wrapper_start');
            $this->load->view('includes/_navbar');
            $this->load->view('includes/_aside');
            $this->load->view('_student/seatwork/seatwork_index', $data);
            $this->load->view('includes/_footer');
		    $this->load->view('includes/_wrapper_end');
		} else {
            redirect(base_url(), 'refresh');
		}
    }

    public function browse_seatworks_stud_class()
    {
        $this->form_validation->set_rules('selectClass', 'Class', 'trim|required');
        $this->form_validation->set_rules('selectTerm', 'Class', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('selectClass')) > 0 || !empty(trim($this->input->post('selectClass')))) {
                $data['classes_by_class'] = $this->activities->browse_seatworks_stud_class(trim($this->input->post('selectClass')), trim($this->input->post('selectTerm')));
                $data['response'] = 'true';
                $data['message'] = 'Read seatwork Successful';
                $this->load->view('_student/seatwork/response/seatwork_table_list_class', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No seatwork selected';
            }
        }
    }

    public function browse_seatworks_stud_term()
    {
        $this->form_validation->set_rules('selectTerm', 'Term', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('selectTerm')) > 0 || !empty(trim($this->input->post('selectTerm')))) {
                $data['classes_by_term'] = $this->activities->browse_seatworks_stud_term(trim($this->input->post('selectTerm')));
                $data['response'] = 'true';
                $data['message'] = 'Read seatwork Successful';
                $this->load->view('_student/seatwork/response/seatwork_table_list_term', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No seatwork selected';
            }
        }
    }

    public function browse_submitted_seatworks_class()
    {
        $this->form_validation->set_rules('selectClass', 'Class', 'trim|required');
        $this->form_validation->set_rules('selectTerm', 'Class', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('selectClass')) > 0 || !empty(trim($this->input->post('selectClass')))) {
                $data['classes_by_class'] = $this->activities->browse_submitted_seatworks_class(trim($this->input->post('selectClass')), trim($this->input->post('selectTerm')));
                $data['response'] = 'true';
                $data['message'] = 'Read seatwork submitted Successful';
                $this->load->view('seatwork/response/seatwork_table_list_class', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No seatwork selected';
            }
        }
    }

    public function browse_submitted_seatworks_term()
    {
        $this->form_validation->set_rules('selectTerm', 'Term', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('selectTerm')) > 0 || !empty(trim($this->input->post('selectTerm')))) {
                $data['classes_by_term'] = $this->activities->browse_submitted_seatworks_term(trim($this->input->post('selectTerm')));
                $data['response'] = 'true';
                $data['message'] = 'Read seatwork submitted Successful';
                $this->load->view('seatwork/response/seatwork_table_list_term', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No seatwork selected';
            }
        }
    }

    public function open_seatwork()
    {
        $this->form_validation->set_rules('seatwork_id', 'Seatwork ID', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('seatwork_id')) > 0 || !empty(trim($this->input->post('seatwork_id')))) {
                $data['opened_seatwork'] = $this->activities->open_seatwork(trim($this->input->post('seatwork_id')));
                $data['response'] = 'true';
                $data['message'] = 'Read seatwork Successful';
                $this->load->view('_student/seatwork/modal/opened_seatwork', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No seatwork selected';
            }
        }
    }

    public function open_seatwork_teacher()
    {
        $this->form_validation->set_rules('sw_reply_id', 'Seatwork ID', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('sw_reply_id')) > 0 || !empty(trim($this->input->post('sw_reply_id')))) {
                $data['opened_seatwork'] = $this->activities->open_seatwork_teacher(trim($this->input->post('sw_reply_id')));
                $data['response'] = 'true';
                $data['message'] = 'Read seatwork Successful';
                $this->load->view('seatwork/modals/opened_seatwork', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No seatwork selected';
            }
        }
    }

    public function submit_seatwork()
    {
        $this->form_validation->set_rules('hidden_seatwork_id', 'Seatwork id', 'required');
        $this->form_validation->set_rules('hidden_teacher_id', 'Teacher id', 'required');
        $this->form_validation->set_rules('hidden_subject_id', 'Subject id', 'required');
        // $this->form_validation->set_rules('hidden_student_id', 'student id', 'required');
        $this->form_validation->set_rules('hidden_term', 'Term', 'required');
        $this->form_validation->set_rules('hidden_seatwork_title', 'Seatwork title', 'required');

        // $this->form_validation->set_rules('input_activity_score', 'Points', 'required|numeric');
        $this->form_validation->set_rules('textarea_seatwork', 'Text content', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
					  $fileName = $_FILES['userfile']['name'];
            $seatworkData = array(
                'seatwork_id' => trim($this->input->post('hidden_seatwork_id')),
                'teacher_id' => trim($this->input->post('hidden_teacher_id')),
                'subject_id' => trim($this->input->post('hidden_subject_id')),
                'student_id' => $this->session->userdata('user_id'),
                'seatwork_title' => trim($this->input->post('hidden_seatwork_title')),
                'editor_content' => trim($this->input->post('textarea_seatwork')),
              'attached_file' => $fileName,
                // 'type' => 'seatwork',
                'term' => trim($this->input->post('hidden_term')),
                // 'score' => trim($this->input->post('input_activity_score')),
                'status' => 0,
                // 'deadline' => trim($this->input->post('input_deadline')),
                'created_at' => date('Y-m-d h:i:s'),
                // 'updated_at' => date('Y-m-d h:i:s'),
            );

            $term = str_replace(' ','',$seatworkData['term']);
            if (!file_exists('./public/uploads/activities/seatworks/'.$term.'/answers/')) {
                mkdir('./public/uploads/activities/seatworks/'.$term.'/answers/', 0777, true);
            }
                $config = array();
                $config['upload_path'] = './public/uploads/activities/seatworks/'.$term.'/answers/';
                $config['allowed_types'] = 'gif|jpg|png|pdf|docx|xlsx|pptx';
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
                    $_FILES['userfile']['type'] = $files['userfile']['type'];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'];
                    $_FILES['userfile']['error'] = $files['userfile']['error'];
                    $_FILES['userfile']['size'] = $files['userfile']['size'];
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload())
                    {
                        $data['response'] = "false";
                        $data['errors'] = $this->upload->display_errors();
                    } else {
                        $fileName = $_FILES['userfile']['name'];
                        $images[] = $fileName;
                        $udata['upload_data'] = array($this->upload->data());
                        $data_type = $udata['upload_data'];
                        foreach ($data_type as $val)
                        {
                            $file_ext = $val['file_ext'];
                            $orig_file = $val['orig_name'];
                        }
                        $new_name = $seatworkData['seatwork_id'].'_'.$seatworkData['student_id'].'_'.time().'_'.rand(0,100000)."".$file_ext;
                        rename($config['upload_path'].'/'.$orig_file, $config['upload_path'].'/'.$new_name);
                        $seatworkData['attached_file'] = trim($new_name);
                    }
                }

            $this->activities->submit_seatwork($seatworkData);

	        $data['response'] = "true";
	        $data['message'] = 'Seatwork Submitted!';
        }
	    echo json_encode($data);
    }

    public function submit_seatwork_score()
    {
        $this->form_validation->set_rules('hidden_sw_reply_id', 'Seatwork Reply id', 'required');
        $this->form_validation->set_rules('hidden_seatwork_id', 'Seatwork id', 'required');
        $this->form_validation->set_rules('input_activity_score', 'Points', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {

            $seatworkData = array(
                'sw_reply_id' => trim($this->input->post('hidden_sw_reply_id')),
                'seatwork_id' => trim($this->input->post('hidden_seatwork_id')),
                'student_score' => trim($this->input->post('input_activity_score')),
            );

            $this->activities->submit_seatwork_score($seatworkData);

	        $data['response'] = "true";
	        $data['message'] = 'Seatwork Score Posted!';
        }
	    echo json_encode($data);
    }


    public function homework_stud()
	{
        if($this->session->userdata('user_id') != null) {
            // redirect(base_url('activities'), 'refresh');
            $data['title'] = "Homework - NVAC Portal";
            $data['module'] = "Activities";
            $data['function'] = "Seatwork";

            $aside = array(
                'menu'  => 'activities',
                'submenu'     => 'homework',
            );
            $this->session->set_flashdata($aside);

            $data['classes'] = $this->activities->read_subjects_by_class($this->session->classcode);

            $this->load->view('includes/_wrapper_start');
            $this->load->view('includes/_navbar');
            $this->load->view('includes/_aside');
            $this->load->view('_student/homework/homework_index', $data);
            $this->load->view('includes/_footer');
		    $this->load->view('includes/_wrapper_end');
		} else {
            redirect(base_url(), 'refresh');
		}
    }

    public function browse_homeworks_stud_class()
    {
        $this->form_validation->set_rules('selectClass', 'Class', 'trim|required');
        $this->form_validation->set_rules('selectTerm', 'Class', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('selectClass')) > 0 || !empty(trim($this->input->post('selectClass')))) {
                $data['classes_by_class'] = $this->activities->browse_homeworks_stud_class(trim($this->input->post('selectClass')), trim($this->input->post('selectTerm')));
                $data['response'] = 'true';
                $data['message'] = 'Read homework Successful';
                $this->load->view('_student/homework/response/homework_table_list_class', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No homework selected';
            }
        }
    }

    public function browse_homeworks_stud_term()
    {
        $this->form_validation->set_rules('selectTerm', 'Term', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('selectTerm')) > 0 || !empty(trim($this->input->post('selectTerm')))) {
                $data['classes_by_term'] = $this->activities->browse_homeworks_stud_term(trim($this->input->post('selectTerm')));
                $data['response'] = 'true';
                $data['message'] = 'Read homework Successful';
                $this->load->view('_student/homework/response/homework_table_list_term', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No homework selected';
            }
        }
    }

    public function browse_submitted_homeworks_class()
    {
        $this->form_validation->set_rules('selectClass', 'Class', 'trim|required');
        $this->form_validation->set_rules('selectTerm', 'Class', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('selectClass')) > 0 || !empty(trim($this->input->post('selectClass')))) {
                $data['classes_by_class'] = $this->activities->browse_submitted_homeworks_class(trim($this->input->post('selectClass')), trim($this->input->post('selectTerm')));
                $data['response'] = 'true';
                $data['message'] = 'Read homework submitted Successful';
                $this->load->view('homework/response/homework_table_list_class', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No homework selected';
            }
        }
    }

    public function browse_submitted_homeworks_term()
    {
        $this->form_validation->set_rules('selectTerm', 'Term', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('selectTerm')) > 0 || !empty(trim($this->input->post('selectTerm')))) {
                $data['classes_by_term'] = $this->activities->browse_submitted_homeworks_term(trim($this->input->post('selectTerm')));
                $data['response'] = 'true';
                $data['message'] = 'Read homework submitted Successful';
                $this->load->view('homework/response/homework_table_list_term', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No homework selected';
            }
        }
    }

    public function open_homework()
    {
        $this->form_validation->set_rules('homework_id', 'Seatwork ID', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('homework_id')) > 0 || !empty(trim($this->input->post('homework_id')))) {
                $data['opened_homework'] = $this->activities->open_homework(trim($this->input->post('homework_id')));
                $data['response'] = 'true';
                $data['message'] = 'Read homework Successful';
                $this->load->view('_student/homework/modal/opened_homework', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No homework selected';
            }
        }
    }

    public function open_homework_teacher()
    {
        $this->form_validation->set_rules('hw_reply_id', 'Seatwork ID', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('hw_reply_id')) > 0 || !empty(trim($this->input->post('hw_reply_id')))) {
                $data['opened_homework'] = $this->activities->open_homework_teacher(trim($this->input->post('hw_reply_id')));
                $data['response'] = 'true';
                $data['message'] = 'Read homework Successful';
                $this->load->view('homework/modals/opened_homework', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No homework selected';
            }
        }
    }

    public function submit_homework()
    {
        $this->form_validation->set_rules('hidden_homework_id', 'Seatwork id', 'required');
        $this->form_validation->set_rules('hidden_teacher_id', 'Teacher id', 'required');
        $this->form_validation->set_rules('hidden_subject_id', 'Subject id', 'required');
        $this->form_validation->set_rules('hidden_student_id', 'student id', 'required');
        $this->form_validation->set_rules('hidden_term', 'Term', 'required');
        $this->form_validation->set_rules('hidden_homework_title', 'Seatwork title', 'required');

        // $this->form_validation->set_rules('input_activity_score', 'Points', 'required|numeric');
        $this->form_validation->set_rules('textarea_homework', 'Text content', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {

            $homeworkData = array(
                'homework_id' => trim($this->input->post('hidden_homework_id')),
                'teacher_id' => trim($this->input->post('hidden_teacher_id')),
                'subject_id' => trim($this->input->post('hidden_subject_id')),
                'student_id' => trim($this->input->post('hidden_student_id')),
                'homework_title' => trim($this->input->post('hidden_homework_title')),
                'editor_content' => trim($this->input->post('textarea_homework')),
                // 'attached_file' => trim($this->input->post('userfile')),
                // 'type' => 'homework',
                'term' => trim($this->input->post('hidden_term')),
                // 'score' => trim($this->input->post('input_activity_score')),
                'status' => 0,
                // 'deadline' => trim($this->input->post('input_deadline')),
                'created_at' => date('Y-m-d h:i:s'),
                // 'updated_at' => date('Y-m-d h:i:s'),
            );

            $term = str_replace(' ','',$homeworkData['term']);
            if (!file_exists('./public/uploads/activities/homeworks/'.$term.'/answers/')) {
                mkdir('./public/uploads/activities/homeworks/'.$term.'/answers/', 0777, true);
            }
                $config = array();
                $config['upload_path'] = './public/uploads/activities/homeworks/'.$term.'/answers/';
                $config['allowed_types'] = 'gif|jpg|png|pdf|docx|xlsx|pptx';
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
                    $_FILES['userfile']['type'] = $files['userfile']['type'];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'];
                    $_FILES['userfile']['error'] = $files['userfile']['error'];
                    $_FILES['userfile']['size'] = $files['userfile']['size'];
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload())
                    {
                        $data['response'] = "false";
                        $data['errors'] = $this->upload->display_errors();
                    } else {
                        $fileName = $_FILES['userfile']['name'];
                        $images[] = $fileName;
                        $udata['upload_data'] = array($this->upload->data());
                        $data_type = $udata['upload_data'];
                        foreach ($data_type as $val)
                        {
                            $file_ext = $val['file_ext'];
                            $orig_file = $val['orig_name'];
                        }
                        $new_name = $homeworkData['homework_id'].'_'.$homeworkData['student_id'].'_'.time().'_'.rand(0,100000)."".$file_ext;
                        rename($config['upload_path'].'/'.$orig_file, $config['upload_path'].'/'.$new_name);
                        $homeworkData['attached_file'] = trim($new_name);
                    }
                }

            $this->activities->submit_homework($homeworkData);

	        $data['response'] = "true";
	        $data['message'] = 'Homework Submitted!';
        }
	    echo json_encode($data);
    }

    public function submit_homework_score()
    {
        $this->form_validation->set_rules('hidden_homework_id', 'Homework id', 'required');
        $this->form_validation->set_rules('input_activity_score', 'Points', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {

            $homeworkData = array(
                'homework_id' => trim($this->input->post('hidden_homework_id')),
                'student_score' => trim($this->input->post('input_activity_score')),
            );

            $this->activities->submit_homework_score($homeworkData);

	        $data['response'] = "true";
	        $data['message'] = 'Homework Score Posted!';
        }
	    echo json_encode($data);
    }



// PLAY LISTTTTTT
public function Video_PlaylistIndex(){
    if($this->session->userdata('user_id') != null) {
            $data['title'] = "Dashboard - NVAC Portal";
            $aside = array(
                    'menu'  => 'activities',
                    'submenu'     => 'playlists',
            );
            $this->session->set_flashdata($aside);
            $data['Subjectplaylist'] = $this->activities->GetMylistSubject();

            $this->load->view('includes/_wrapper_start');
            $this->load->view('includes/_navbar');
            $this->load->view('includes/_aside');
            $this->load->view('VideoPlaylist/VideoPlaylistIndex', $data);
            $this->load->view('includes/_footer');
    $this->load->view('includes/_wrapper_end');
} else {
            redirect(base_url(), 'refresh');
}
}


public function GetPlaylist(){
    if($this->session->userdata('user_id') != null) {
    $data = array();
    $playlist =  $this->input->post('Subcode');
    if($playlist){
    $con['conditions'] = array('playlist'=>$playlist);
    $data = $this->activities->GetplayList($con);
    }
    echo json_encode($data);

} else {
                redirect(base_url(), 'refresh');
}
}

public function Getlesson(){
    if($this->session->userdata('user_id') != null) {
        $data = array();
        $lessonID =  $this->input->post('lessonID');
        if($lessonID){
        $con['conditions'] = array('lessonID'=>$lessonID);
        $data['lesson'] = $this->activities->LessonId($con);

        $this->load->view('VideoPlaylist/Modal/Modalview',$data);
        }
        // echo json_encode($data);
        // $lessonID =  $this->input->post('lessonID');
        //  $data = $this->activities->LessonId($lessonID);
} else {
                redirect(base_url(), 'refresh');
}
}
// end OF PLAY LIST


}
