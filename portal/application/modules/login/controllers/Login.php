<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('migration_login', 'login');
		// $this->load->library('session');
    }

    public function index()
	{
        if($this->session->userdata('user_id') != null) {
            redirect(base_url('dashboard'), 'refresh');
		} else {
            $data['title'] = 'Login - NVAC Portal';
		    $this->load->view('login', $data);
		}
    }

    public function verify_credentials()
	{
		$this->output->enable_profiler(false);
		$this->form_validation->set_rules('input_email', 'Email', 'required');
		$this->form_validation->set_rules('input_password', 'Password', 'required');

		$validation_result = $this->form_validation->run($this);
		if ($validation_result) {
			$post_data = array(
				'email' => trim($this->input->post('input_email')),
				'password' => md5(trim($this->input->post('input_password'))),
            );
            $user_credentials = $this->login->search_account_if_existing($post_data);
            if(!$user_credentials == 0){
                foreach($user_credentials as $user)
                {
                    $user_session = array(
                        'user_id' => $user["user_id"],
                        'email' => $user["email"],
                        'role' => $user["role_display_name"],
                        'role_id' => $user["role_id"],
                        'logged_in' => true
                    );

                    $this->session->set_userdata($user_session);
                    // var_dump($this->session->has_userdata('lastname'));
                    // die();
                }
                // redirect('dashboard');
                $data['response'] = 'true';
                $data['message'] = 'logged in';
            } else {
                $data['response'] = 'false';
                $data['message'] = 'Email or Password is incorrect.';
            }

            // var_dump($user_credentials);
            // die();

			// $data['response'] = "true";
            // $data['message'] = 'Logged in.';

            // redirect('dashboard');

		} else {
            $this->session->set_userdata('message_failed', 'login failed');
            redirect('login');
            $data['response'] = "false";
            $data['message'] = validation_errors();

		}
		echo json_encode($data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
	
        redirect(base_url(), 'refresh');
    }

}
