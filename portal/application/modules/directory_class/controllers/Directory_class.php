<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Directory_class extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('migration_directory_class', 'directory_class');
    }
    
    public function class_information()
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
            
             $data['title'] = "Class Directory - NVAC Portal"; 
             $data['module'] = "Class Information";
             $data['function'] = "Class Information";

            $aside = array(
                'menu'  => 'class directory',
                'submenu'     => 'class_information',
            );
            $this->session->set_flashdata($aside);

            $data['teachers_list'] = $this->directory_class->load_list_of_teachers();
            
            $this->load->view('includes/_wrapper_start');
            $this->load->view('includes/_navbar');
            $this->load->view('includes/_aside');
            $this->load->view('directory_class_index', $data);
            $this->load->view('includes/_footer');
		    $this->load->view('includes/_wrapper_end');
		} else {
            redirect(base_url(), 'refresh');
		}
    }
    public function generate_class_table(){
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));


        $class = $this->directory_class->class_list();

        $data = array();

        foreach($class->result() as $cls) {

             $data[] = array(
                '<input type="checkbox" id="chk_class_delete" name="chk_class_delete[]" value="'.$cls->id.'">',
                !empty($cls->subjectcode) ? $cls->subjectcode : $cls->blockclassid,
                  $cls->subjectname,
                  $cls->schedule,
                  $cls->name,
                 '<button type="button" class="btn btn-success btn-sm edit" id="btn_edit" data-classid="class-'.$cls->id.'" data-toggle="modal" data-target="#class_edit"><i class="fa fa-edit"></i> Edit</button></a>'.
                 '<button type="button" class="btn btn-info btn-sm read" id="btn_read" data-classid="class-'.$cls->id.'" data-toggle="modal" data-target="#class_read"><i class="fa fa-eye"></i> View</button>'.
                 '<button type="button" class="btn btn-danger btn-sm delete"  data-classid="class-'.$cls->id.'" data-toggle="modal" data-target="#class_delete"><i class="fa fa-trash"></i> Delete</button>'
             );
        }

        $output = array(
             "draw" => $draw,
               "recordsTotal" => $class->num_rows(),
               "recordsFiltered" => $class->num_rows(),
               "data" => $data
          );
        echo json_encode($output);
        exit();
    }

    public function delete_class()
    {
        $this->form_validation->set_rules('id', 'Class ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('id')) > 0 || !empty(trim($this->input->post('id')))) {
                $data['class_delete_details'] = $this->directory_class->delete_class(trim($this->input->post('id')));
                $data['response'] = 'true';
                $data['message'] = 'Class Deleted';
                // $this->load->view('directory_class_index', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Class selected';
            }
        }
    }
    public function bulk_delete_class(){
        $this->form_validation->set_rules('id', 'Class IDs', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $classIds = explode(',', trim($this->input->post('id')));

            // print_r($subjectIds);exit;
            if( $classIds > 0 || !empty($classIds)) {
                for ($i=0; $i < count($classIds); $i++) { 
                    $deleteClass = $this->directory_class->delete_class($classIds[$i]);
                }
                $data['response'] = 'true';
                $data['message'] = 'Staffs Deleted';
                // $this->load->view('directory_student_index', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Staffs selected';
            }
        }
    }

    public function read_class()
    {
        $this->form_validation->set_rules('id', 'Class ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('id')) > 0 || !empty(trim($this->input->post('id')))) {
                $data['class_details'] = $this->directory_class->read_class(trim($this->input->post('id')));
                $data['response'] = 'true';
                $data['message'] = 'Read Class Successful';
                $this->load->view('response/_read_class', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Class selected';
            }
        }
    }

    public function edit_class()
    {
        $this->form_validation->set_rules('id', 'Class ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('id')) > 0 || !empty(trim($this->input->post('id')))) {
                $data['class_details'] = $this->directory_class->read_class(trim($this->input->post('id')));
                $data['response'] = 'true';
                $data['message'] = 'Read Class Successful';
                $this->load->view('response/_edit_class', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Class selected';
            }
        }
    }

    public function insert_edit_class()
    {
        $this->form_validation->set_rules('hidden_id', 'Class ID', 'required');
        $this->form_validation->set_rules('input_subjectcode', 'Subject Code', '');
        $this->form_validation->set_rules('input_subjectname', 'Subject Name', 'required');
        $this->form_validation->set_rules('input_subjectdesc', 'Subject Description', 'required');
        $this->form_validation->set_rules('input_section', 'Section', 'required');
        $this->form_validation->set_rules('input_schedule', 'Schedule', 'required');
        $this->form_validation->set_rules('input_teacherid', 'Teacher id', 'required');
        $this->form_validation->set_rules('input_block_classcode', 'Blockcodeid', '');
       
        
        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            
            $classData = array(
                'id' => trim($this->input->post('hidden_id')),
                'subjectcode' => trim($this->input->post('input_subjectcode')),
                'subjectname' => trim($this->input->post('input_subjectname')),
                'subjectdesc' => trim($this->input->post('input_subjectdesc')),
                'section' => trim($this->input->post('input_section')),
                'schedule' => trim($this->input->post('input_schedule')),
                'teacherid' => trim($this->input->post('input_teacherid')),
                'blockclassid' => trim($this->input->post('input_block_classcode')),
                
                // 'created_at' => date('Y-m-d h:i:s'),
                // 'updated_at' => date('Y-m-d h:i:s'),
            );

            $this->directory_class->update_class($classData);
	        
	        $data['response'] = "true";
	        $data['message'] = 'Class Edited!';
        }
	    echo json_encode($data);
    }

    public function search_class()
    {
        $this->form_validation->set_rules('searchItem', 'Searched Item', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('searchItem')) > 0 || !empty(trim($this->input->post('searchItem')))) {
                $data['searched_class'] = $this->directory_class->search_class(trim($this->input->post('searchItem')));
                $data['response'] = 'true';
                $data['message'] = 'Search Class Successful';
                $this->load->view('response/_searched_class', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = '<div class="card-body mt-0 pt-0"><div class="alert alert-warning alert-dismissible"><h5><i class="fa fa-exclamation-triangle"></i> Alert!</h5>Class does not exist.</div></div>';
            }
        }
    }

    public function add_class()
    {
        $this->form_validation->set_rules('input_subjectcode', 'Subject Code', 'required');
        $this->form_validation->set_rules('input_subjectname', 'Subject Name', 'required');
        $this->form_validation->set_rules('input_subjectdesc', 'Subject Description', 'required');
        $this->form_validation->set_rules('input_section', 'Section', 'required');
        $this->form_validation->set_rules('select_instructor', 'Instructor', 'required');
        $this->form_validation->set_rules('input_sched', 'Schedule day', '');
        $this->form_validation->set_rules('input_time', 'Schedule time from', 'required');
        $this->form_validation->set_rules('input_time1', 'Schedule time to', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            
            $classData = array(
                'subjectcode' => trim($this->input->post('input_subjectcode')),
                'subjectname' => trim($this->input->post('input_subjectname')),
                'subjectdesc' => trim($this->input->post('input_subjectdesc')),
                'section' => trim($this->input->post('input_section')),
                'schedule' => trim($this->input->post('input_sched')).' '.trim($this->input->post('input_time')).'-'.trim($this->input->post('input_time1')),
                'teacherid' => trim($this->input->post('select_instructor')),
                'blockclassid' => trim($this->input->post('input_block_classcode')),
            );

            $this->directory_class->insert_class($classData);
	        
	        $data['response'] = "true";
	        $data['message'] = 'Class Added!';
        }
	    echo json_encode($data);
    }

    public function add_block_class()
    {
        $this->form_validation->set_rules('input_block_class_code', 'Subject Code', 'required');
        $this->form_validation->set_rules('input_block_subjectname', 'Subject Name', '');
        $this->form_validation->set_rules('input_block_subjectdesc', 'Subject Description', '');
        $this->form_validation->set_rules('input_block_section', 'Section', 'required');
        $this->form_validation->set_rules('select_block_instructor', 'Instructor', 'required');
        $this->form_validation->set_rules('input_block_sched', 'Schedule day', '');
        $this->form_validation->set_rules('input_block_time2', 'Schedule time from', 'required');
        $this->form_validation->set_rules('input_block_time3', 'Schedule time to', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            
            $classData = array(
                'blockclassid' => trim($this->input->post('input_block_block_class_code')),
                'subjectname' => trim($this->input->post('input_block_subjectname')),
                'subjectdesc' => trim($this->input->post('input_block_subjectdesc')),
                'section' => trim($this->input->post('input_block_section')),
                'schedule' => trim($this->input->post('input_block_sched')).' '.trim($this->input->post('input_block_time2')).'-'.trim($this->input->post('input_block_time3')),
                'teacherid' => trim($this->input->post('select_instructor')),
                'blockclassid' => trim($this->input->post('input_block_class_code')),
            );

            $this->directory_class->insert_class($classData);
	        
	        $data['response'] = "true";
	        $data['message'] = 'Block Class Added!';
        }
	    echo json_encode($data);
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
        
       $filename = 'class_'.date('Ymd').'.csv'; 
       header("Content-Description: File Transfer"); 
       header("Content-Disposition: attachment; filename=$filename"); 
       header("Content-Type: application/csv; ");
       $classData = $this->directory_class->get_all_classes();
        $file = fopen('php://output', 'w');
        $header = array("subjectcode","subjectname","subjectdesc","section","schedule","teacherid","blockclassid"); 
        fputcsv($file, $header);
        foreach ($classData as $key=>$line){ 
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
