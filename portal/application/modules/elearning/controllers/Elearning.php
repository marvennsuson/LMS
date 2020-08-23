<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;

class Elearning extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('migration_elearning', 'elearning');
        $this->load->model('activities/migration_activities', 'activities');

							$this->load->model('Elearning_model');
							// $this->load->library('pagination');
							$this->load->library('pdf');
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

		function GetPdfilebooks(){

	 $data["getFile"] = $this->Elearning_model->GetFilePDF(trim($this->input->post('BooksFile')));

$this->load->view('modal/Pdfviewer',$data);
		}

    public function ebooks()
	{
        if($this->session->userdata('user_id') != null) {
					$config = array();
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
			    $config['per_page'] = 5;
					$config['base_url'] = base_url('/elearning/Elearning/ebooks/');
					$config['total_rows'] = $this->Elearning_model->Bookslist();
					$this->pagination->initialize($config);
			    $page = ( $this->uri->segment(4) ) ? $this->uri->segment(4) : 0;
					$data["gebooks"] = $this->Elearning_model->GetEbooksList($config["per_page"], $page);
					$data["links"] = $this->pagination->create_links();



            $data['title'] = "E-learning - NVAC Portal";
						$data['GetSubject'] = $this->Elearning_model->GetSectionBySubjCode();
						// $data['gebooks'] = $this->Elearning_model->GetEbooksList();
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

            $aside = array(
                'menu'  => 'elearning',
                'submenu'     => 'download_center',
            );
            $this->session->set_flashdata($aside);

            $data['classes'] = $this->elearning->get_all_subject_by_student();

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

		public function downloadfile(){
			  $name = $this->uri->segment(4);
// $path =  base_url('public/uploads/elearning/').$name;
// force_download($file, $uribase);
$this->load->helper('file');
	 $this->load->helper('download');
$pth    =   file_get_contents(base_url()."public/uploads/elearning/".$name);
$nme    =   $name;
force_download($nme, $pth);

		}

public function ModuleDownload(){
	$this->load->helper('file');
		 $this->load->helper('download');
			$name = $this->uri->segment(4);
$pth    =   file_get_contents(base_url()."public/uploads/Ebooks/".$name);
$nme    =   $name;
force_download($nme, $pth);



}

public function ebooksStudent(){
	$data['title'] = "E-learning - NVAC Portal";
	$data['GetSubject'] = $this->Elearning_model->GetSectionBySubjCode();
	// $data['gebooks'] = $this->Elearning_model->GetEbooksList();
	$this->load->view('includes/_wrapper_start');
	$this->load->view('includes/_navbar');
	$this->load->view('includes/_aside');
	$this->load->view('ebooksStudentIndex', $data);
	$this->load->view('includes/_footer');
$this->load->view('includes/_wrapper_end');
}

    public function upload_center()
	{
        if($this->session->userdata('user_id') != null) {
            // redirect(base_url('elearning'), 'refresh');
            $data['title'] = "E-learning - NVAC Portal";

            $aside = array(
                'menu'  => 'elearning',
                'submenu'     => 'upload_center',
            );
            $this->session->set_flashdata($aside);

            $data['classes'] = $this->activities->get_all_subject_by_teacher();
            // $data['downloads_list'] = $this->elearning->get_all_downloads_by_teacher();
						$data['subjectlist'] = $this->elearning->GetSubjectTeacher();
            $this->load->view('includes/_wrapper_start');
            $this->load->view('includes/_navbar');
            $this->load->view('includes/_aside');
            $this->load->view('upload_center', $data);
            $this->load->view('includes/_footer');
		    $this->load->view('includes/_wrapper_end');
		} else {
            redirect(base_url(), 'refresh');
		}
    }

    public function insert_upload()
    {
        $this->form_validation->set_rules('select_class', 'Class', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {

            $uploadData = array(
                'subjectcode' => trim($this->input->post('select_class')),
                'uploaded_by' => $this->session->user_id,
                'created_at' => date('Y-m-d h:i:s'),
            );

            $config = array();
            $config['upload_path'] = './public/uploads/elearning/';
            $config['allowed_types'] = 'pdf|csv|xlsx|docx|ppt|pptx';
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
                    $data['message'] = $this->upload->display_errors();
                } else {
                    $udata['upload_data'] = array($this->upload->data());
                    $data_type = $udata['upload_data'];
                    foreach ($data_type as $val)
                    {
                        $file_ext = $val['file_ext'];
                        $orig_file = $val['orig_name'];
                    }
                    $new_name = str_pad(mt_rand(0,9999),4,"0",STR_PAD_LEFT)."_".$orig_file;

                    rename($config['upload_path'].'/'.$orig_file, $config['upload_path'].'/'.$new_name);
                    $uploadData['filename'] = trim($new_name);

                    $this->elearning->insert_upload($uploadData);
                    $data['response'] = "true";
	                $data['message'] = 'File Uploaded!';
                }
            }

        }
	    echo json_encode($data);
    }

    public function search_download_by_class()
    {
        $this->form_validation->set_rules('studentClass', 'Student Level', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('studentClass')) > 0 || !empty(trim($this->input->post('studentClass')))) {
                $data['downloads_list'] = $this->elearning->search_download_by_class(trim($this->input->post('studentClass')));

                $data['response'] = 'true';
                $data['message'] = 'Select Student Type Successful';
                $this->load->view('_response_downloads_list', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'No Student Type selected';
            }
        }
        // echo json_encode($data);
    }


		public function GetFilelistBySubject()
		{

						if( trim($this->input->post('subcode')) > 0 || !empty(trim($this->input->post('subcode')))) {
								$data['downloads_list'] = $this->elearning->get_all_downloads_by_teacher(trim($this->input->post('subcode')));

								$data['response'] = 'true';
								$data['message'] = 'Select Subject Code Successful';
								$this->load->view('TeacherSearchtable', $data);
						} else {
								$data['response'] = 'false';
								$data['message'] = 'No Student Type selected';
						}

				// echo json_encode($data);
		}
// FEATURES FOR CATEGORIES EBOOKS
		// public function GetEbooksList(){
		// 	$this->Elearning_model->GetEbooksList(trim($this->input->post('subcode')));
		// }

}
