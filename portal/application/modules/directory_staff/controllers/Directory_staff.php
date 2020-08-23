<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Directory_staff extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('migration_directory_staff', 'directory_staff');
    }
    
    public function staff_information()
	{
        if($this->session->userdata('user_id') != null) {
            $config = array();
            $config['base_url'] = base_url('/directory_staff/staff_information/');
            $config['total_rows'] = $this->directory_staff->count_all_staffs();
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
            $data["staff_lists"] = $this->directory_staff->staff_lists_by_page($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
            
            $data['title'] = "Staff Directory - NVAC Portal"; 
            $data['module'] = "Staff Information";
            $data['function'] = "Staff Information";

            $aside = array(
                'menu'  => 'staff directory',
                'submenu'     => 'staff_information',
            );
            $this->session->set_flashdata($aside);

            $data['role_lists'] = $this->directory_staff->role_lists();
            
            $this->load->view('includes/_wrapper_start');
            $this->load->view('includes/_navbar');
            $this->load->view('includes/_aside');
            $this->load->view('directory_staff_index', $data);
            $this->load->view('includes/_footer');
		    $this->load->view('includes/_wrapper_end');
		} else {
            redirect(base_url(), 'refresh');
		}
    }

    public function generate_staff_table(){
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));


        $staff = $this->directory_staff->staff_list();


        // echo json_encode($staff->result());exit;
        $data = array();

        foreach($staff->result() as $stf) {

             $data[] = array(
                  '<input type="checkbox" id="chk_staff_delete" name="chk_staff_delete[]" value="'.$stf->teacher_id.'">',
                  $stf->staffcode,
                  $stf->name,
                  $stf->gender,
                  $stf->role_display_name,
                 '<button type="button" class="btn btn-success btn-sm edit" id="btn_edit" data-classid="staff-'.$stf->teacher_id.'" data-toggle="modal" data-target="#staff_edit"><i class="fa fa-edit"></i> Edit</button></a>'.
                 '<button type="button" class="btn btn-info btn-sm read" id="btn_read" data-classid="staff-'.$stf->teacher_id.'" data-toggle="modal" data-target="#staff_read"><i class="fa fa-eye"></i> View</button>'.
                 '<button type="button" class="btn btn-danger btn-sm delete"  data-classid="staff-'.$stf->teacher_id.'" data-toggle="modal" data-target="#staff_delete"><i class="fa fa-trash"></i> Delete</button>'
             );

        }
        
        $output = array(
             "draw" => $draw,
               "recordsTotal" => $staff->num_rows(),
               "recordsFiltered" => $staff->num_rows(),
               "data" => $data
          );
        echo json_encode($output);
        exit();
    }

    public function delete_staff()
    {
        $this->form_validation->set_rules('id', 'Staff ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('id')) > 0 || !empty(trim($this->input->post('id')))) {
                $data['staff_delete_details'] = $this->directory_staff->delete_staff(trim($this->input->post('id')));
                $data['response'] = 'true';
                $data['message'] = 'Staff Deleted';
                // $this->load->view('directory_staff_index', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Staff selected';
            }
        }
    }
    public function bulk_delete_staff(){
        $this->form_validation->set_rules('id', 'Staff IDs', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $staffIds = explode(',', trim($this->input->post('id')));

            // print_r($subjectIds);exit;
            if( $staffIds > 0 || !empty($staffIds)) {
                for ($i=0; $i < count($staffIds); $i++) { 
                    $deleteStaffs = $this->directory_staff->delete_staff($staffIds[$i]);
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

    public function read_staff()
    {
        $this->form_validation->set_rules('teacher_id', 'Staff ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('id')) > 0 || !empty(trim($this->input->post('id')))) {
                $data['staff_details'] = $this->directory_staff->read_staff(trim($this->input->post('id')));
                $data['response'] = 'true';
                $data['message'] = 'Read Staff Successful';
                $this->load->view('response/_read_staff', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Staff selected';
            }
        }
    }

    public function edit_staff()
    {
        $this->form_validation->set_rules('id', 'Staff ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('id')) > 0 || !empty(trim($this->input->post('id')))) {
                $data['staff_details'] = $this->directory_staff->read_staff(trim($this->input->post('id')));
                $data['response'] = 'true';
                $data['message'] = 'Read Staff Successful';
                $this->load->view('response/_edit_staff', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Staff selected';
            }
        }
    }

    public function insert_edit_staff()
    {
        $this->form_validation->set_rules('input_fullname', 'First Name', 'required');
        $this->form_validation->set_rules('hidden_id', 'Teacher ID', 'required');
        $this->form_validation->set_rules('select_gender', 'Gender', 'required');
        $this->form_validation->set_rules('input_email', 'Email', 'valid_email');
        $this->form_validation->set_rules('select_role', 'Role', 'required');
        $this->form_validation->set_rules('input_address', 'Address', 'required');
        $this->form_validation->set_rules('input_bday', 'Birth Day', 'required');
        $this->form_validation->set_rules('input_phone', 'Phone', 'required');
        $this->form_validation->set_rules('input_teaching_load', 'Teaching Loads', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $age = date_diff(date_create($this->input->post('input_bday')), date_create('today'))->y;
            $staffData = array(
                'teacher_id' => trim($this->input->post('hidden_id')),
                'name' => trim($this->input->post('input_fullname')),
                'gender' => trim($this->input->post('select_gender')),
                'role' => trim($this->input->post('select_role')),
                'birthday' => trim($this->input->post('input_bday')),
                'email' => trim($this->input->post('input_email')),
                'mobile' => trim($this->input->post('input_phone')),
                'age' => $age,
                'address' => trim($this->input->post('input_address')),
                'teaching_load' => trim($this->input->post('input_teaching_load'))
            );

            $this->directory_staff->update_staff($staffData);
	        
	        $data['response'] = "true";
	        $data['message'] = 'Staff Edited!';
        }
	    echo json_encode($data);
    }

    public function search_staff()
    {
        $this->form_validation->set_rules('searchItem', 'Searched Item', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('searchItem')) > 0 || !empty(trim($this->input->post('searchItem')))) {
                $data['searched_staff'] = $this->directory_staff->search_staff(trim($this->input->post('searchItem')));
                $data['response'] = 'true';
                $data['message'] = 'Search Staff Successful';
                $this->load->view('response/_searched_staff', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = '<div class="card-body mt-0 pt-0"><div class="alert alert-warning alert-dismissible"><h5><i class="fa fa-exclamation-triangle"></i> Alert!</h5>Staff does not exist.</div></div>';
            }
        }
    }

    public function add_staff()
    {
        $this->form_validation->set_rules('input_fname', 'First Name', 'required');
        $this->form_validation->set_rules('input_mname', 'Middle Name', '');
        $this->form_validation->set_rules('input_lname', 'Last Name', 'required');
        $this->form_validation->set_rules('input_staff_id', 'Teacher ID', 'required');
        $this->form_validation->set_rules('select_gender', 'Gender', 'required');
        $this->form_validation->set_rules('input_email', 'Email', 'valid_email');
        $this->form_validation->set_rules('select_role', 'Role', 'required');
        $this->form_validation->set_rules('input_address', 'Address', 'required');
        $this->form_validation->set_rules('input_bday', 'Birth Day', 'required');
        $this->form_validation->set_rules('input_phone', 'Phone', 'required');
        $this->form_validation->set_rules('input_teaching_loads', 'Teaching Loads', 'required');

        // echo json_encode($_POST['input_bday']);
        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $age = date_diff(date_create($this->input->post('input_bday')), date_create('today'))->y;
            $staffData = array(
                'staffcode' => trim($this->input->post('input_staff_id')),
                'name' => trim($this->input->post('input_fname')) . ' ' . trim($this->input->post('input_mname')) . ' '. trim($this->input->post('input_lname')),
                'gender' => trim($this->input->post('select_gender')),
                'role' => trim($this->input->post('select_role')),
                'birthday' => trim($this->input->post('input_bday')),
                'email' => trim($this->input->post('input_email')),
                'mobile' => trim($this->input->post('input_phone')),
                'address' => trim($this->input->post('input_address')),
                'teaching_load' => trim($this->input->post('input_teaching_loads')),
                'age' => $age
            );
            
            if ($_FILES) {
                $config = array();
                $config['upload_path'] = './public/uploads/profiles/';
                $config['allowed_types'] = 'gif|jpg|png|tiff|bmp|jpeg';
                $config['max_size'] = '2048';
                $config['overwrite'] = FALSE;
                $config['detect_mime'] = TRUE;
                $config['mod_mime_fix'] = TRUE;
                $config['remove_spaces'] = TRUE;
                $config['file_ext_tolower'] = TRUE;
                $this->load->library('upload', $config);
                $files = $_FILES;

                $_FILES['userfile']['name'] = $files['userfile']['name'];
                $this->upload->initialize($config);

                if (!$this->upload->do_upload())
                {
                    $data['response'] = "false";
                    $data['message'] = $this->upload->display_errors();
                } else {
                    $udata['upload_data'] = array($this->upload->data());
                    $data_type = $udata['upload_data'];
                    foreach ($data_type as $val) 
                    {
                        $file_ext = $val['file_ext'];
                        $orig_file = $val['orig_name'];
                    }
                    $new_name = $staffData['staffid'].'_'.time().'_'.rand(0,100000)."".$file_ext;
                    rename($config['upload_path'].'/'.$orig_file, $config['upload_path'].'/'.$new_name);
                    $staffData['photo'] = trim($new_name);
                }
            }else{
                $staffData['photo'] = '';
            }
       
            $this->directory_staff->insert_staff($staffData);
            $data['response'] = "true";
	        $data['message'] = 'Staff Inserted!';
	        
        }
	    echo json_encode($data);
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
                    
                    if(!empty($csvData)){
                        foreach($csvData as $row){
                            $rowCount++;
                            $staffData['name']= $row["name"];
                            $staffData['email']= $row["email"];
                            $staffData['address']=$row["address"];
                            $staffData['age']=$row["age"];
                            $staffData['birthday']=$row["birthday"];
                            $staffData['mobile']=$row["mobile"];
                            $staffData['gender']=$row["gender"];
                            $staffData['staffcode']=$row["staffcode"];
                            $staffData['role']=$row["role"];
                            $staffData['teaching_load']=$row["teaching_load"];
                            
                            // echo json_encode($this->directory_staff->search_staff($row["staffcode"]));
                            // exit;
                            if($this->directory_staff->search_staff($row["staffcode"])){
                                $staffId=$this->directory_staff->search_staff($row["staffcode"]);
                                $staffData['teacher_id']=$staffId[0]['teacher_id'];
                                $this->directory_staff->update_staff($staffData);
                            }
                            else{
                                $this->directory_staff->insert_staff($staffData);
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
        // echo 1;exit;
        $filename = 'staffinfo_'.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
        $classData = $this->directory_staff->get_all_teachers();
         $file = fopen('php://output', 'w');
         $header = array("name","email","address","age","birthday","mobile","gender","staffcode","role","teaching_load"); 
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