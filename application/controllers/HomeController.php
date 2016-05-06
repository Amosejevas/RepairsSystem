<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {
	function __construct()
    {
        parent::__construct();
    }

	public function index() {
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['username']= $session_data['username'];
			$role = $this->User->getUserRole($this->session->userdata('username'));
        	if( $role == 'Admin') {
        		redirect('admin/Users');
		   		$this->load->view('adminLayout');
		    } else {
				$this->load->view('homeView', $data);			    	
		    }
		} else {
			// $this->load->view('loginView');
			redirect('UsersController/login');
		}
	}
}
?>