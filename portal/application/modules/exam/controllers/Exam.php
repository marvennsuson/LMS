<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exam extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('migration_exam', 'exam');
        $this->load->model('activities/migration_activities', 'activities');
    }

	// public function index()
	// {
    //     if($this->session->userdata('user_id') != null) {
    //         // redirect(base_url('exam'), 'refresh');
    //         $data['title'] = "Exam - NVAC Portal"; 
            
    //         $this->load->view('includes/_wrapper_start');
    //         $this->load->view('includes/_navbar');
    //         $this->load->view('includes/_aside');
    //         $this->load->view('exam', $data);
    //         $this->load->view('includes/_footer');
	// 	    $this->load->view('includes/_wrapper_end');
	// 	} else {
    //         redirect(base_url(), 'refresh');
	// 	}
    // }
    
    public function exam_header()
	{
        if($this->session->userdata('user_id') != null) {
            $data['title'] = "Exam Header - NVAC Portal";

            $aside = array(
                'menu'  => 'exam',
                'submenu'     => 'exam_header',
            );
            $this->session->set_flashdata($aside);

            $data['exam_header'] = $this->exam->read_exam_header();
            
            $this->load->view('includes/_wrapper_start');
            $this->load->view('includes/_navbar');
            $this->load->view('includes/_aside');
            $this->load->view('exam_header', $data);
            $this->load->view('includes/_footer');
		    $this->load->view('includes/_wrapper_end');
		} else {
            redirect(base_url(), 'refresh');
		}
    }

    public function create_exam_header()
    {
         
        $this->form_validation->set_rules('input_exam_title', 'Exam Title', 'required');
        $this->form_validation->set_rules('select_exam_term', 'Exam Term', 'required');
        $this->form_validation->set_rules('select_exam_type', 'Exam Type', 'required');
        // $this->form_validation->set_rules('select_exam_attempt', 'Exam Attempt', 'required');
        $this->form_validation->set_rules('input_exam_expiration', 'Expiration Date', 'required');
        // $this->form_validation->set_rules('input_exam_passingrate', 'Passing Rate', 'required');
        $this->form_validation->set_rules('input_exam_timeduration', 'Time Duration', 'required');
        $this->form_validation->set_rules('textarea_exam_instruction', 'Instruction', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            
            $updateData = array(
                'classcode' => '',
                'term' => trim($this->input->post('select_exam_term')),
                'type' => trim($this->input->post('select_exam_type')),
                'exam_title' => trim($this->input->post('input_exam_title')),
                // 'exam_attempt' => trim($this->input->post('select_exam_attempt')),
                'expiration_date' => trim($this->input->post('input_exam_expiration')),
                // 'passing_rate' => trim($this->input->post('input_exam_passingrate')),
                'time_duration' => trim($this->input->post('input_exam_timeduration')),
                'instruction' => trim($this->input->post('textarea_exam_instruction')),
                'created_by' => $this->session->user_id,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            );
            
            $this->exam->insert_exam_header($updateData);
	        
	        $data['response'] = "true";
	        $data['message'] = 'Exam Header Created!';
        }
	    echo json_encode($data);
    }

    public function delete_exam_header()
    {
        $this->form_validation->set_rules('examheaderId', 'Exam Header ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('examheaderId')) > 0 || !empty(trim($this->input->post('examheaderId')))) {
                $this->exam->delete_exam_header(trim($this->input->post('examheaderId')));
                $data['response'] = 'true';
                $data['message'] = 'Exam Header Deleted';
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Exam Header deleted';
            }
        }
    }

    public function browse_exam_header()
    {
        $this->form_validation->set_rules('examheaderId', 'Exam Header ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('examheaderId')) > 0 || !empty(trim($this->input->post('examheaderId')))) {
                $data['browse_exam_header'] = $this->exam->browse_exam_header(trim($this->input->post('examheaderId')));
                $data['response'] = 'true';
                $data['message'] = 'Exam Header Browsed';
                $this->load->view('edit_exam_header', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Exam Header browsed';
            }
        }
    }

    public function edit_exam_header()
    {
         
        $this->form_validation->set_rules('input_exam_header_id', 'Exam Header ID', 'required');
        $this->form_validation->set_rules('input_exam_title1', 'Exam Title', 'required');
        $this->form_validation->set_rules('select_exam_term', 'Exam Term', 'required');
        $this->form_validation->set_rules('select_exam_type1', 'Exam Type', 'required');
        // $this->form_validation->set_rules('select_exam_attempt', 'Exam Attempt', 'required');
        $this->form_validation->set_rules('input_exam_expiration', 'Expiration Date', 'required');
        // $this->form_validation->set_rules('input_exam_passingrate', 'Passing Rate', 'required');
        $this->form_validation->set_rules('input_exam_timeduration', 'Time Duration', 'required');
        $this->form_validation->set_rules('textarea_exam_instruction', 'Instruction', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            
            $updateData = array(
                'classcode' => '',
                'term' => trim($this->input->post('select_exam_term')),
                'type' => trim($this->input->post('select_exam_type1')),
                'exam_header_id' => trim($this->input->post('input_exam_header_id')),
                'exam_title' => trim($this->input->post('input_exam_title1')),
                // 'exam_attempt' => trim($this->input->post('select_exam_attempt')),
                'expiration_date' => trim($this->input->post('input_exam_expiration')),
                // 'passing_rate' => trim($this->input->post('input_exam_passingrate')),
                'time_duration' => trim($this->input->post('input_exam_timeduration')),
                'instruction' => trim($this->input->post('textarea_exam_instruction')),
                'created_by' => $this->session->user_id,
            );
            
            $this->exam->edit_exam_header($updateData);
	        
	        $data['response'] = "true";
	        $data['message'] = 'Exam Header Edited!';
        }
	    echo json_encode($data);
    }
    

    public function exam_body()
	{
        if($this->session->userdata('user_id') != null) {
            $data['title'] = "Exam Body - NVAC Portal";

            $aside = array(
                'menu'  => 'exam',
                'submenu'     => 'exam_body',
            );
            $this->session->set_flashdata($aside);

            $data['exam_body'] = $this->exam->read_exam_body();
            
            $this->load->view('includes/_wrapper_start');
            $this->load->view('includes/_navbar');
            $this->load->view('includes/_aside');
            $this->load->view('exam_body', $data);
            $this->load->view('includes/_footer');
		    $this->load->view('includes/_wrapper_end');
		} else {
            redirect(base_url(), 'refresh');
		}
    }

    public function create_exam_body()
    {
         
        $this->form_validation->set_rules('created_exam_form', 'Created Form', 'required');
        $this->form_validation->set_rules('input_exam_body_title', 'Exam Body Title', 'required');
        $this->form_validation->set_rules('input_exam_body_points', 'Exam Points', 'required');
        // $this->form_validation->set_rules('select_exam_body_random', 'Exam Random', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $createExamForm = array(
                'exam_body_title' => trim($this->input->post('input_exam_body_title')),
                'exam_created_form' => trim($this->input->post('created_exam_form')),
                'total_points' => trim($this->input->post('input_exam_body_points')),
                // 'is_random' => trim($this->input->post('select_exam_body_random')),
                'created_by' => $this->session->user_id,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            );

            $this->exam->add_exam_body($createExamForm);
	        
	        $data['response'] = "true";
	        $data['message'] = 'Exam Form Created!';
        }
	    echo json_encode($data);
    }

    public function edit_exam_body()
    {
         
        $this->form_validation->set_rules('input_exam_body_id', 'Exam Body ID', 'required');
        $this->form_validation->set_rules('input_exam_body_title', 'Exam Body Title', 'required');
        $this->form_validation->set_rules('input_exam_points', 'Exam Points', 'required');
        // $this->form_validation->set_rules('select_exam_random', 'Random', 'required');
        $this->form_validation->set_rules('textarea_exam_form_in_html', 'Html Form', '');
        
        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            
            $updateData = array(
                'classcode' => '',
                'exam_body_id' => trim($this->input->post('input_exam_body_id')),
                'exam_body_title' => trim($this->input->post('input_exam_body_title')),
                'exam_created_form' => trim(str_replace(array('contenteditable="true"', 'px-4 py-4', 'style="background-color: rgb(255, 241, 198);"'), '', $this->input->post('textarea_exam_form_in_html'))),
                'total_points' => trim($this->input->post('input_exam_points')),
                // 'is_random' => trim($this->input->post('select_exam_random')),
            );
            
            $this->exam->edit_exam_body($updateData);
	        
	        $data['response'] = "true";
	        $data['message'] = 'Exam Body Updated!';
        }
	    echo json_encode($data);
    }

    public function browse_exam_body()
    {
        $this->form_validation->set_rules('exambodyID', 'Exam Body ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('exambodyID')) > 0 || !empty(trim($this->input->post('exambodyID')))) {
                $data['browse_exam_body'] = $this->exam->browse_exam_body(trim($this->input->post('exambodyID')));
                $data['response'] = 'true';
                $data['message'] = 'Exam Body Browsed';
                $this->load->view('edit_exam_body', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Exam Body browsed';
            }
        }
    }

    public function delete_exam_body()
    {
        $this->form_validation->set_rules('exambodyID', 'Exam Body ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('exambodyID')) > 0 || !empty(trim($this->input->post('exambodyID')))) {
                $this->exam->delete_exam_body(trim($this->input->post('exambodyID')));
                $data['response'] = 'true';
                $data['message'] = 'Exam Body Deleted';
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Exam Body deleted';
            }
        }
    }

    public function join_header_body()
    {
        if($this->session->userdata('user_id') != null) {
            $data['title'] = "Join Exam Header and Body - NVAC Portal";

            $aside = array(
                'menu'  => 'exam',
                'submenu'     => 'join_header_body',
            );
            $this->session->set_flashdata($aside);
            $data['all_exam_header'] = $this->exam->browse_all_exam_header();
            $data['all_exam_body'] = $this->exam->browse_all_exam_body();
            $data['exam_lists'] = $this->exam->browse_exam();
            
            $this->load->view('includes/_wrapper_start');
            $this->load->view('includes/_navbar');
            $this->load->view('includes/_aside');
            $this->load->view('join_header_body', $data);
            $this->load->view('includes/_footer');
		    $this->load->view('includes/_wrapper_end');
		} else {
            redirect(base_url(), 'refresh');
		} 
    }

    public function create_exam()
    {
         
        $this->form_validation->set_rules('select_exam_header', 'Exam Body', 'required');
        $this->form_validation->set_rules('select_exam_body', 'Exam Header', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            
            $createExam = array(
                'exam_header_id' => trim($this->input->post('select_exam_header')),
                'exam_body_id' => trim($this->input->post('select_exam_body')),
                'created_by' => $this->session->user_id,
                'date_created' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            );
            
            $this->exam->create_exam($createExam);
	        
	        $data['response'] = "true";
	        $data['message'] = 'Exam Body Updated!';
        }
	    echo json_encode($data);
    }

    public function browse_exam_header_to_join()
    {
        $this->form_validation->set_rules('examheaderId', 'Exam Header ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('examheaderId')) > 0 || !empty(trim($this->input->post('examheaderId')))) {
                $data['browse_exam_header'] = $this->exam->browse_exam_header(trim($this->input->post('examheaderId')));
                $data['response'] = 'true';
                $data['message'] = 'Exam Header Browsed';
                $this->load->view('browsed_exam_header', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Exam Header browsed';
            }
        }
    }

    public function browse_exam_body_to_join()
    {
        $this->form_validation->set_rules('exambodyId', 'Exam Header ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('exambodyId')) > 0 || !empty(trim($this->input->post('exambodyId')))) {
                $data['browse_exam_body'] = $this->exam->browse_exam_body(trim($this->input->post('exambodyId')));
                $data['response'] = 'true';
                $data['message'] = 'Exam Body Browsed';
                $this->load->view('browsed_exam_body', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Exam Header browsed';
            }
        }
    }

    public function browse_exam()
    {
        $this->form_validation->set_rules('examID', 'Exam Header ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('examID')) > 0 || !empty(trim($this->input->post('examID')))) {
                $data['browse_exam'] = $this->exam->browse_joined_exam(trim($this->input->post('examID')));
                $data['all_exam_header'] = $this->exam->browse_all_exam_header();
                $data['all_exam_body'] = $this->exam->browse_all_exam_body();
                $data['response'] = 'true';
                $data['message'] = 'Exam Header Browsed';
                $this->load->view('edit_exam', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Exam Header browsed';
            }
        }
    }

    public function edit_exam()
    {
         
        $this->form_validation->set_rules('select_exam_header', 'Exam Body', 'required');
        $this->form_validation->set_rules('select_exam_body', 'Exam Header', 'required');
        $this->form_validation->set_rules('hidden_joined_header_body_id', 'Joined Header Body', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            
            $configExam = array(
                'joined_header_body_id' => trim($this->input->post('hidden_joined_header_body_id')),
                'exam_header_id' => trim($this->input->post('select_exam_header')),
                'exam_body_id' => trim($this->input->post('select_exam_body')),
                'created_by' => $this->session->user_id,
            );
            
            $this->exam->edit_exam($configExam);
	        
	        $data['response'] = "true";
	        $data['message'] = 'Exam Body Updated!';
        }
	    echo json_encode($data);
    }

    public function delete_exam()
    {
        $this->form_validation->set_rules('examID', 'Exam ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('examID')) > 0 || !empty(trim($this->input->post('examID')))) {
                $this->exam->delete_exam(trim($this->input->post('examID')));
                $data['response'] = 'true';
                $data['message'] = 'Exam Body Deleted';
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Exam Body deleted';
            }
        }
        echo json_encode($data);
    }

    public function online_exam_index()
	{
        if($this->session->userdata('user_id') != null) {
            // redirect(base_url('exam'), 'refresh');
            $data['title'] = "Online Exam - NVAC Portal";

            $aside = array(
                'menu'  => 'exam',
                'submenu'     => 'online_exam_index',
            );
            $this->session->set_flashdata($aside);

            // $data['exam_lists_quiz'] = $this->exam->exam_lists('quiz');
            // $data['exam_lists_exam'] = $this->exam->exam_lists('exam');
            // $data['exam_lists_finals'] = $this->exam->exam_lists('final exam');

            $data['classes'] = $this->exam->get_all_subject_by_student();
            
            $this->load->view('includes/_wrapper_start');
            $this->load->view('includes/_navbar');
            $this->load->view('includes/_aside');
            $this->load->view('online_exam_index', $data);
            $this->load->view('includes/_footer');
		    $this->load->view('includes/_wrapper_end');
		} else {
            redirect(base_url(), 'refresh');
		}
    }

    // public function student_browse_exam()
    // {
    //     $this->form_validation->set_rules('examID', 'Exam ID', 'trim|required|numeric');
    //     if ($this->form_validation->run() == FALSE){
    //         $data['response'] = "false";
    //         $data['message'] = validation_errors();
    //     } else {
    //         if( trim($this->input->post('examID')) > 0 || !empty(trim($this->input->post('examID')))) {
    //             $data['exam'] = $this->exam->read_exam(trim($this->input->post('examID')));
    //             $data['response'] = 'true';
    //             $data['message'] = 'Exam Read';
    //             $this->load->view('exam_quiz_modal_carousel', $data);
    //         } else {
    //             $data['response'] = 'false';
    //             $data['message'] = 'No Exam Header browsed';
    //         }
    //     }
    // }

    public function student_browse_exam($examID)
    {
        if($this->session->userdata('user_id') != null) {
            // redirect(base_url('exam'), 'refresh');
            $data['title'] = "Online Exam - NVAC Portal";

            $data['exam'] = $this->exam->read_exam($examID);
            
            $this->load->view('includes/_wrapper_start');
            // $this->load->view('includes/_navbar');
            // $this->load->view('includes/_aside');
            $this->load->view('exam_quiz_modal_carousel', $data);
            // $this->load->view('includes/_footer');
		    $this->load->view('includes/_wrapper_end');
		} else {
            redirect(base_url(), 'refresh');
		}
    }

    public function submit_exam()
    {
        $this->form_validation->set_rules('hidden_term', 'Term', 'required');
        $this->form_validation->set_rules('hidden_type', 'Type', 'required');
        $this->form_validation->set_rules('hidden_input_score', 'Exam Score', 'required');
        $this->form_validation->set_rules('hidden_classes_id', 'Classes ID', 'required');
        $this->form_validation->set_rules('hidden_teacher_id', 'Teacher ID', 'required');
        $this->form_validation->set_rules('hidden_student_id', 'Student ID', 'required');
        $this->form_validation->set_rules('hidden_joined_header_body_id', 'Exam joined header body ID', 'required');
        $this->form_validation->set_rules('hidden_exam_header_id', 'Exam header ID', 'required');
        $this->form_validation->set_rules('hidden_exam_body_id', 'Exam body ID', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            
            $examData = array(
                'term' => trim($this->input->post('hidden_term')),
                'type' => trim($this->input->post('hidden_type')),
                'classes_id' => trim($this->input->post('hidden_classes_id')),
                'joined_header_body_id' => trim($this->input->post('hidden_joined_header_body_id')),
                'exam_header_id' => trim($this->input->post('hidden_exam_header_id')),
                'exam_body_id' => trim($this->input->post('hidden_exam_body_id')),
                'student_id' => $this->session->user_id,
                'teacher_id' => trim($this->input->post('hidden_teacher_id')),
                'score' => trim($this->input->post('hidden_input_score')),
            );
            
            $this->exam->submit_exam($examData);
	        
	        $data['response'] = "true";
	        $data['message'] = 'Exam Submitted!';
        }
	    echo json_encode($data);
    }

    public function assign_exam()
    {
         
        $this->form_validation->set_rules('input_exam_id', 'Exam ID', 'required');
        $this->form_validation->set_rules('select_class', 'class', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $createExam = array(
                'joined_header_body_id' => trim($this->input->post('input_exam_id')),
                'class' => trim($this->input->post('select_class')),
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            );
            $this->exam->assign_exam($createExam);
	        
	        $data['response'] = "true";
	        $data['message'] = 'Exam Body Updated!';
        }
	    echo json_encode($data);
    }

    public function config_exam()
    {
         
        $this->form_validation->set_rules('hidden_input_exam_id', 'Exam ID', 'required');
        $this->form_validation->set_rules('allow_retake', 'Allow retake', '');
        $this->form_validation->set_rules('publish_result_to_student', 'Publish score', '');
        $this->form_validation->set_rules('make_exam_visible', 'Make exam visible', '');
        
        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            
            $configExam = array(
                'joined_header_body_id' => trim($this->input->post('hidden_input_exam_id')),
                'allow_retake' => trim($this->input->post('allow_retake')),
                'publish_score_to_student' => trim($this->input->post('publish_result_to_student')),
                'make_exam_visible' => trim($this->input->post('make_exam_visible')),
            );
            
            $this->exam->config_exam($configExam);
	        
	        $data['response'] = "true";
	        $data['message'] = 'Exam Body Updated!';
        }
	    echo json_encode($data);
    }

    public function browse_classes_by_teacher()
    {
        $this->form_validation->set_rules('examID', 'Exam ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('examID')) > 0 || !empty(trim($this->input->post('examID')))) {
                // $data['all_classes_by_teacher'] = $this->exam->browse_classes_by_teacher();
                $data['all_classes_by_teacher'] = $this->activities->get_all_subject_by_teacher();
                $data['all_assigned_exam'] = $this->exam->browse_assigned_exam(trim($this->input->post('examID')));
                $data['response'] = 'true';
                $data['message'] = 'Exam Header Browsed';
                $data['exam_id'] = trim($this->input->post('examID'));
                $this->load->view('assigned_exam_modal', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Exam Header browsed';
            }
        }
    }

    public function delete_assigned_exam()
    {
        $this->form_validation->set_rules('assignedExamID', 'Exam ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('assignedExamID')) > 0 || !empty(trim($this->input->post('assignedExamID')))) {
                $this->exam->delete_assigned_exam(trim($this->input->post('assignedExamID')));
                $data['response'] = 'true';
                $data['message'] = 'Assigned Exam Deleted';
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Assigned Exam deleted';
            }
        }
        echo json_encode($data);
    }

    public function browse_exam_by_subject()
    {
        $this->form_validation->set_rules('selectTerm', 'Term', 'trim|required');
        $this->form_validation->set_rules('selectType', 'Type', 'trim|required');
        $this->form_validation->set_rules('subjectcode', 'Type', 'trim|required');

        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('selectType')) > 0 || !empty(trim($this->input->post('selectType')))) {
                $data['exam_lists'] = $this->exam->browse_exam_by_subject(trim($this->input->post('selectTerm')), trim($this->input->post('selectType')), trim($this->input->post('subjectcode')));
                
                if(trim($this->input->post('selectType')) == 'quiz'){
                    $data['test_status'] = $this->exam->test_test_quiz(trim($this->input->post('selectTerm')), trim($this->input->post('subjectcode')), $this->session->user_id );
                }

                // var_dump( $data['test_status']);
                // die();

                $data['response'] = 'true';
                $data['message'] = 'Test Searched';
                $this->load->view('exam_lists', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Test Searched';
            }
        }
        // echo json_encode($data);
    }



}