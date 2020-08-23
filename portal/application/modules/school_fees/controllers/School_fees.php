<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class School_fees extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('migration_school_fees', 'school_fees');
    }
    
    public function school_fees_information()
	{
        if($this->session->userdata('user_id') != null) {
            // $config = array();
            // $config['base_url'] = base_url('/directory_class/class_information/');
            // $config['total_rows'] = $this->directory_class->count_all_classes();
            // $config['per_page'] = 10;
            // $config['uri_segment'] = 3;
            // $config["full_tag_open"] = '<ul class="pagination pagination-sm no-margin pull-left">';
            // $config["full_tag_close"] = '</ul>';	
            // $config["first_link"] = "&laquo;";
            // $config["first_tag_open"] = "<li>";
            // $config["first_tag_close"] = "</li>";
            // $config["last_link"] = "&raquo;";
            // $config["last_tag_open"] = "<li>";
            // $config["last_tag_close"] = "</li>";
            // $config['next_link'] = '&gt;';
            // $config['next_tag_open'] = '<li>';
            // $config['next_tag_close'] = '<li>';
            // $config['prev_link'] = '&lt;';
            // $config['prev_tag_open'] = '<li>';
            // $config['prev_tag_close'] = '<li>';
            // $config['cur_tag_open'] = '<li class="active"><a href="#">';
            // $config['cur_tag_close'] = '</a></li>';
            // $config['num_tag_open'] = '<li>';
            // $config['num_tag_close'] = '</li>';
            // $this->pagination->initialize($config);
            // $page = ( $this->uri->segment(3) ) ? $this->uri->segment(3) : 0;
            // $data["class_lists"] = $this->directory_class->class_lists_by_page($config["per_page"], $page);
            // $data["links"] = $this->pagination->create_links();
            
             $data['title'] = "School Fees - NVAC Portal"; 
             $data['module'] = "School Fees Information";
             $data['function'] = "School Fees Information";

            // $aside = array(
            //     'menu'  => 'class directory',
            //     'submenu'     => 'class_information',
            // );
            // $this->session->set_flashdata($aside);

            // $data['teachers_list'] = $this->directory_class->load_list_of_teachers();
            
            $this->load->view('includes/_wrapper_start');
            $this->load->view('includes/_navbar');
            $this->load->view('includes/_aside');
            $this->load->view('school_fees_index', $data);
            $this->load->view('includes/_footer');
		    $this->load->view('includes/_wrapper_end');
		} else {
            redirect(base_url(), 'refresh');
		}
    }
    public function generate_school_fees_table(){
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));


        $schoolFees = $this->school_fees->school_fees_list();

        $data = array();

        foreach($schoolFees->result() as $sf) {

             $data[] = array(
                '<input type="checkbox" id="chk_student_fees_delete" name="chk_student_fees_delete[]" value="'.$sf->student_id.'">',
                $sf->student_id,
                $sf->firstname . " ". $sf->middlename . " ". $sf->lastname,
                $sf->file,
                $sf->description,
                '<button type="button" class="btn btn-success btn-sm edit" id="btn_edit" data-classid="studfee-'.$sf->id.'" data-toggle="modal" data-target="#school_fee_edit"><i class="fa fa-edit"></i> Edit</button></a>'.
                '<button type="button" class="btn btn-info btn-sm read" id="btn_read" data-classid="studfee-'.$sf->id.'" data-toggle="modal" data-target="#studfee_read"><i class="fa fa-eye"></i> View</button>'.
                '<button type="button" class="btn btn-danger btn-sm delete"  data-classid="studfee-'.$sf->id.'" data-toggle="modal" data-target="#studfee_delete"><i class="fa fa-trash"></i> Delete</button>'
             );
        }

        $output = array(
             "draw" => $draw,
               "recordsTotal" => $schoolFees->num_rows(),
               "recordsFiltered" => $schoolFees->num_rows(),
               "data" => $data
          );
        echo json_encode($output);
        exit();
    }

    public function search_student()
    {
        $this->form_validation->set_rules('searchItem', 'Searched Item', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('searchItem')) > 0 || !empty(trim($this->input->post('searchItem')))) {
                $data['searched_student'] = $this->school_fees->search_student(trim($this->input->post('searchItem')));
                $data['response'] = 'true';
                $data['message'] = 'Search Student Successful';
                $this->load->view('response/_searched_students', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = '<div class="card-body mt-0 pt-0"><div class="alert alert-warning alert-dismissible"><h5><i class="fa fa-exclamation-triangle"></i> Alert!</h5>Student does not exist.</div></div>';
            }
        }
    }

    public function selected_student()
    {
        $this->form_validation->set_rules('id', 'Student ID', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('id')) > 0 || !empty(trim($this->input->post('id')))) {
                $data['selected_student'] = $this->school_fees->read_student(trim($this->input->post('id')));
                $data['response'] = 'true';
                $data['message'] = 'Read Student Successful';
                $this->load->view('response/_selected_student', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = '<div class="card-body mt-0 pt-0"><div class="alert alert-warning alert-dismissible"><h5><i class="fa fa-exclamation-triangle"></i> Alert!</h5>Student does not exist.</div></div>';
            }
        }   
    }
  
    public function add_school_fees()
    {
        $this->form_validation->set_rules('userfile', 'PDF File', 'callback_file_check_pdf');
        $this->form_validation->set_rules('input_student_id', 'Student ID', 'trim|required');
        $this->form_validation->set_rules('text_description', 'Description', 'required');
        // $this->form_validation->set_rules('input_section', 'Section', 'required');
        // $this->form_validation->set_rules('select_instructor', 'Instructor', 'required');
        // $this->form_validation->set_rules('input_sched', 'Schedule day', '');
        // $this->form_validation->set_rules('input_time', 'Schedule time from', 'required');
        // $this->form_validation->set_rules('input_time1', 'Schedule time to', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $filename	=	$_FILES['userfile']['name'];
            
            $bill_data = array(
                'student_id' => trim($this->input->post('input_student_id')),
                'file' => $filename,
                'description' => trim($this->input->post('text_description')),
            );

            if (!file_exists('./public/uploads/bills/')) {
                mkdir('./public/uploads/bills/', 0777, true);
            }

            $config = array();
            $config['upload_path'] = './public/uploads/bills/';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = '2048';
            $config['overwrite'] = FALSE;
            $config['detect_mime'] = TRUE;
            $config['mod_mime_fix'] = TRUE;
            $config['remove_spaces'] = TRUE;
            $config['file_ext_tolower'] = TRUE;
            $this->load->library('upload', $config);
            $files = $_FILES;
            if ($files) {
                // $data['files'] = $files;
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
                        $new_name = $bill_data['student_id'].'_'.date("mdY").$file_ext;
                        rename($config['upload_path'].'/'.$orig_file, $config['upload_path'].'/'.$new_name);
                        $bill_data['file'] = trim($new_name);
                }
            }

            $this->school_fees->create_bill($bill_data);
            $data['response'] = "true";
			$data['message'] = 'Bill Created!';

        }
	    echo json_encode($data);
    }
    
    public function edit_school_fee()
    {
        $this->form_validation->set_rules('id', 'School Fees ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('id')) > 0 || !empty(trim($this->input->post('id')))) {
                $schoolFeeInfo = $this->school_fees->read_school_fee($this->input->post('id'));
                // $filename = $schoolFeeInfo['file'];
                // $path = "./public/uploads/bills/";
                // unlink($path.$filename);
                $data['school_fees'] = $schoolFeeInfo;
                $data['response'] = 'true';
                $data['message'] = 'School Fees Info';
                $this->load->view('response/_edit_student_fee', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No School fee selected';
            }
        }
    }

    public function update_school_fees()
    {
        
        $this->form_validation->set_rules('input_student_id', 'Student ID', 'trim|required');
        $this->form_validation->set_rules('text_description', 'Description', 'required');
        $this->form_validation->set_rules('input_stud_fee_id', 'Student fee ID', 'numeric|required');
        $this->form_validation->set_rules('current_file', 'Student fee file name', 'trim|required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $studFeeId = $this->input->post('input_stud_fee_id');
            $filename	=	$_FILES['userfile']['name'];
            $currentFile = $this->input->post('current_file');

            $bill_data = array(
                'student_id' => trim($this->input->post('input_student_id')),
                'description' => trim($this->input->post('text_description'))
            );

            if ($filename != '' || !empty($filename)) {
                unlink('./public/uploads/bills/'.$currentFile);  // delete recent file
                $config = array();
                $config['upload_path'] = './public/uploads/bills/';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = '2048';
                $config['overwrite'] = FALSE;
                $config['detect_mime'] = TRUE;
                $config['mod_mime_fix'] = TRUE;
                $config['remove_spaces'] = TRUE;
                $config['file_ext_tolower'] = TRUE;
                $this->load->library('upload', $config);
                $files = $_FILES;
                if ($files) {
                    // $data['files'] = $files;
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
                            $new_name = $bill_data['student_id'].'_'.date("mdY").$file_ext;
                            rename($config['upload_path'].'/'.$orig_file, $config['upload_path'].'/'.$new_name);
                            $bill_data['file'] = trim($new_name);
                    }
                }

            }else{
                $bill_data['file'] = $currentFile;
            }
                   
            $this->school_fees->update_bill($bill_data, $studFeeId);
            $data['response'] = "true";
			$data['message'] = 'Bill Updated!';

        }
	    echo json_encode($data);
    }
    public function delete_school_fees()
    {
        $this->form_validation->set_rules('id', 'School Fees ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('id')) > 0 || !empty(trim($this->input->post('id')))) {
                $schoolFeeInfo = $this->school_fees->read_school_fee($this->input->post('id'));
                $filename = $schoolFeeInfo['file'];
                $path = "./public/uploads/bills/";
                unlink($path.$filename);

                $data['delete_school_fees'] = $this->school_fees->delete_school_fee(trim($this->input->post('id')));
                $data['response'] = 'true';
                $data['message'] = 'School Fees Delete';
                // $this->load->view('directory_class_index', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No School fee selected';
            }
        }
    }

    public function bulk_upload()
    {
        // echo json_encode($_FILES); 
        // echo json_encode($file['name']);
        $filecount = 0;
        $students = array();
        if (isset($_FILES)) {
            foreach ($_FILES as $file) {
                // echo json_encode($file['name']);
                $explodeFilename = explode('.',$file['name']);
                $file_extension = end($explodeFilename);

                
                if ($file_extension != 'pdf') {
                    $data['response'] = false;
                    $data['message'] = 'all files must be a pdf file';
                    echo json_encode($data);exit;
                }
                

                $students[] = $explodeFilename[0];
            }

            if (!file_exists('./public/uploads/bills/')) {
                mkdir('./public/uploads/bills/', 0777, true);
            }


            $config = array();
            $config['upload_path'] = './public/uploads/bills/';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = '2048';
            $config['overwrite'] = FALSE;
            $config['detect_mime'] = TRUE;
            $config['mod_mime_fix'] = TRUE;
            $config['remove_spaces'] = TRUE;
            $config['file_ext_tolower'] = TRUE;
            $this->load->library('upload', $config);

            $bill_data = array();

            for ($i=0; $i < count($students); $i++) { 

                $bill_data['student_id'] = $students[$i];
                $bill_data['file'] =  $_FILES['files_'.$i]['name'];
                $bill_data['description'] = 'to be updates';


                $studentExist = $this->school_fees->student_exist($students[$i]);
                
                $_FILES['userfile']['name'] = $_FILES['files_'.$i]['name'];
                $_FILES['userfile']['type'] = $_FILES['files_'.$i]['type'];
                $_FILES['userfile']['tmp_name'] = $_FILES['files_'.$i]['tmp_name'];
                $_FILES['userfile']['error'] = $_FILES['files_'.$i]['error'];
                $_FILES['userfile']['size'] = $_FILES['files_'.$i]['size'];
                if ($studentExist == true) {
                    // update
                    unlink($config['upload_path'].$students[$i].'.pdf');
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload())
                    {
                            $data['response'] = "false";
                            $data['message'] = $this->upload->display_errors();
                            echo json_encode($data);exit;
                    } else {
                            // $fileName = $_FILES['userfile']['name'];
                            // $images[] = $fileName;
                            $udata['upload_data'] = array($this->upload->data());
                            $data_type = $udata['upload_data'];
                            foreach ($data_type as $val)
                            {
                                    $file_ext = $val['file_ext'];
                                    $orig_file = $val['orig_name'];
                            }
                            $new_name = $bill_data['student_id'].$file_ext;
                            rename($config['upload_path'].'/'.$orig_file, $config['upload_path'].'/'.$new_name);
                            $bill_data['file'] = trim($new_name);

                    }

                    $this->school_fees->update_bill_student_id($bill_data, $students[$i]);
            
                }else{
                    // insert
                   
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload())
                    {
                            $data['response'] = false;
                            $data['message'] = $this->upload->display_errors();
                            echo json_encode($data);exit;
                    } else {
                            // $fileName = $_FILES['userfile']['name'];
                            // $images[] = $fileName;
                            $udata['upload_data'] = array($this->upload->data());
                            $data_type = $udata['upload_data'];
                            foreach ($data_type as $val)
                            {
                                    $file_ext = $val['file_ext'];
                                    $orig_file = $val['orig_name'];
                            }
                            $new_name = $bill_data['student_id'].$file_ext;
                            rename($config['upload_path'].'/'.$orig_file, $config['upload_path'].'/'.$new_name);
                            $bill_data['file'] = trim($new_name);
                    }
                    
                    $this->school_fees->create_bill($bill_data);
                    
                }

            }

            $data['response'] = true;
            $data['message'] = 'Bill Created!';
        }

        echo json_encode($data);exit;


    }

    public function bulk_delete_fee()
    {
        $this->form_validation->set_rules('id', 'Student fee IDs', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $sf_id = explode(',', trim($this->input->post('id')));

            // print_r($subjectIds);exit;
            if( $sf_id > 0 || !empty($sf_id)) {
                for ($i=0; $i < count($sf_id); $i++) { 
                    $filename = $sf_id[$i].'.pdf';
                    $path = "./public/uploads/bills/";
                    unlink($path.$filename);
                    $deleteClass = $this->school_fees->delete_school_fee_student($sf_id[$i]);

                }
                $data['response'] = 'true';
                $data['message'] = 'Student fees Deleted';
                // $this->load->view('directory_student_index', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No studen fee selected';
            }
        }
    }
    public function import_csv(){
        $data = array();
        $classData = array();
        
            $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');
            if($this->form_validation->run() == true){
                $insertCount = $updateCount = $rowCount = $notAddCount = 0; 
                 if(is_uploaded_file($_FILES['file']['tmp_name'])){
                     $this->load->library('CSVReader');
                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
                    if(!empty($csvData)){
                        foreach($csvData as $row){
                            $rowCount++;
                            $classData['subjectcode']=$row["subjectcode"];
                            $classData['subjectname']=$row["subjectname"];
                            $classData['subjectdesc']=$row["subjectdesc"];
                            $classData['section']=$row["section"];
                            $classData['schedule']=$row["schedule"];
                            $classData['teacherid']=$row["teacherid"];
                            $classData['blockclassid']=$row["blockclassid"];
                        
                            if($this->directory_class->search_class($row["subjectcode"])){
                                $class_id=$this->directory_class->search_class($row["subjectcode"]);
                                $classData['id']=$class_id[0]['id'];
                                 $this->directory_class->update_class($classData);
                            }
                             else{
                                $this->directory_class->insert_class($classData);
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
        
       $filename = 'school_fees_'.date('Ymd').'.csv'; 
       header("Content-Description: File Transfer"); 
       header("Content-Disposition: attachment; filename=$filename"); 
       header("Content-Type: application/csv; ");
       $schoolFees = $this->school_fees->get_all_school_fees();
        $file = fopen('php://output', 'w');
        $header = array("student_id","file","description"); 
        fputcsv($file, $header);
        foreach ($schoolFees as $key=>$line){ 
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

    public function file_check_pdf($str){
        // $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if(isset($_FILES['userfile']['name']) && $_FILES['userfile']['name'] != ""){
            // $mime = get_mime_by_extension($_FILES['file']['name']);
            $fileAr = explode('.', $_FILES['userfile']['name']);
            $ext = end($fileAr);
            if($ext == 'pdf'){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

}
