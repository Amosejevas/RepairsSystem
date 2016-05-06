<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersController extends CI_Controller {
	function __construct() {
        parent::__construct();
    }


	public function login() {
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">','</div>');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password',
        	'trim|required|callback_check_database');
        if($this->form_validation->run() == FALSE) {
        	$error_messages = 'Login is incorrect';
	        $this->load->view('loginView');
	    } else {
	    	$username = $this->input->post('username');
	    	$this->session->set_userdata('username', $username);
	    	redirect('', 'refresh');
	    }
	}
	function check_database($password) {
        //Field validation succeeded.  Validate against database
        $username = $this->input->post('username');
        //query the database
        $result = $this->User->login($username, $password);
	   	if($result) {
	    	$sess_array = array();
	    	foreach($result as $row)
	    	{
		    	$sess_array = array(
		            'id' => $row->id,
		            'username' => $row->username
		        );
		        $this->session->set_userdata('logged_in', $sess_array);
	        }
	    	return TRUE;
	    } else {
	     $this->form_validation->set_message('check_database', 'Invalid username or password');
	     return false;
	    }
	}
	public function logout() {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('', 'refresh');
    }

    function checkEmpty($str) {
    	if ($str == '') {
    		 $this->form_validation->set_message('checkEmpty', 'The {field} field can not be an emty string');
    		 return FALSE;
    	}
    	return TRUE;
    }

    public function register() {
    	$this->form_validation->set_rules('username', 'username', 'trim|Required|min_length[5]|callback_checkEmpty');
    	$this->form_validation->set_rules('email', 'email', 'trim|Required|valid_email');
    	$this->form_validation->set_rules('password', 'password', 'trim|Required|min_length[5]|callback_checkEmpty');
    	$this->form_validation->set_rules('reppass'. 'Reppass', 'trim|required|matches[password]');
    	$username = $this->input->post('username');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
    	if ($this->form_validation->run() == TRUE) {
    		$user = $this->User->login($username, $password);
    		if(!$user) {
	    		$role = 1; //USER
	    		$this->User->register($username, $email, $password, $role);
	    		$this->session->set_userdata('user_role_id', $role);
	    		$this->session->set_userdata('logged_in', true);
	    		$this->session->set_userdata('user_id', $user);
	    		$this->session->set_userdata('username', $username);
			    redirect('', 'refresh');
    		} else {
    			echo 'toks yra _', $username ,'_';
				// $this->load->view('registerView');
    		}
    	} else {
				$this->load->view('registerView');
    	}
    }
    public function sendEmails() {
		$config = Array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'ssl://smtp.googlemail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'progeniuz@gmail.com',
		    'smtp_pass' => 'mutchagile',
		    'mailtype'  => 'html', 
		    'charset'   => 'iso-8859-1'
		);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");

		$this->email->from('henrikasamosejevas@gmail.com', 'Henrikas');
    	$this->email->to('karolisammo@gmail.com'); 

    	$this->email->subject('Email Test');
   		$this->email->message('Hello from web.');  

		// Set to, from, message, etc.

		$result = $this->email->send();
		$this->session->set_userdata('sendStatus', $result);
		$this->load->view('sendView');
    }
}
?>