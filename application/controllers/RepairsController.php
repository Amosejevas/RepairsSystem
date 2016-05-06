<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RepairsController extends CI_Controller {
	function __construct() {
        parent::__construct();
    }

    function checkEmpty($str) {
    	if ($str == '') {
    		 $this->form_validation->set_message('checkEmpty', 'The {field} field can not be an emty string');
    		 return FALSE;
    	}
    	return TRUE;
    }

    function update_status() {
        $match = $this->input->post('filter');
        redirect('RepairsController/myRepairs', 'refresh');
    }

    public function myRepairs() {
        if (!empty($_POST['buttonSubmit'])) {
            $repairId = $this->input->post('repairId');
            $status = $this->input->post('status');            
            $this->Repair->updateRepairStatus($repairId, $status);
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
            $this->email->to('henrrikas@gmail.com'); 
            $this->email->subject('Repair status update');
            $this->email->message("Your repair status has been changed to {$status}.");  
            $result = $this->email->send();
        }
        if (!empty($_POST['buttonAccept'])) {
            $repairId = $this->input->post('repairId');
            $email = $this->input->post('email');
            $this->Repair->accept($repairId);
            sendEmail($email, 'Your ticket has been accepted');
        }
        if (!empty($_POST['buttonDecline'])) {
            $repairId = $this->input->post('repairId');
            $email = $this->input->post('email');
            $this->Repair->decline($repairId);
            sendEmail($email, 'Your ticket has been declined');
        }

        $filterButton = 'filter';
        $match = $this->input->post('filter');
        if(!empty($match)) {
            $filterButton = 'reset';
        }
    	$typeArray = array();
    	$role = $this->User->getUserRole($this->session->userdata('username'));
        if( $role == 'Repairman' || $role == 'Admin') {
            echo $role;
    	    $results = $this->Repair->getAllRepairsFiltered($match);
        } else {
       	    $results = $this->Repair->getUserRepairs($this->session->userdata('username'), $match);
        } 
    	$result = $results->result_array();
    	$this->load->view('myRepairsView', array(
    			'UserRepairsList' => $result,
                'filterButton' => $filterButton
    		));

    }

	public function register() {
    	$this->form_validation->set_rules('ticket_type',
    		                              'Ticket_type',
    		                              'trim|required|callback_checkEmpty');
    	$this->form_validation->set_rules('serial_number',
    		                              'Serial_number',
    		                              'trim|required|callback_checkEmpty');
    	$this->form_validation->set_rules('device_name',
    		                              'Device_name',
    		                              'trim|required|callback_checkEmpty');
    	$this->form_validation->set_rules('fault_description',
    		                              'Fault_description',
    		                              'trim|required|callback_checkEmpty');
    	if ($this->form_validation->run() == TRUE) {
    		$ticket_type = $this->input->post('ticket_type');
            $serial_number = $this->input->post('serial_number');
            $device_name = $this->input->post('device_name');
            $fault_description = $this->input->post('fault_description');
	    	$this->Repair->register($ticket_type, $serial_number, $device_name, $fault_description);
	    	$insert_id = $this->db->insert_id();
	    	$userId = $this->User->getUserId($this->session->userdata('username'));
	        $row = $userId->row();
	        $this->UserRepair->register($row->id ,$insert_id);
	        $_POST = array();  
			$this->load->view('registerRepairView', array(
    					'PrevType'=> '',
    					'PrevSerial'=> '',
    					'PrevModel'=> '',
    					'PrevDescr'=> '',
    					'Success'=> '<div class="alert alert-success" role="alert">A repair has been registered</div>'
    				));	
    		} else {
    			$ticket_type = $this->input->post('ticket_type');
	            $serial_number = $this->input->post('serial_number');
	            $device_name = $this->input->post('device_name');
	            $fault_description = $this->input->post('fault_description');
	            if(!isset($ticket_type)) $ticket_type = '';
	            if(!isset($serial_number)) $ticket_type = '';
	            if(!isset($device_name)) $ticket_type = '';
	            if(!isset($fault_description)) $ticket_type = '';
    			$this->load->view('registerRepairView', array(
    					'PrevType'=> $ticket_type,
    					'PrevSerial'=> $serial_number,
    					'PrevModel'=> $device_name,
    					'PrevDescr'=> $fault_description,
    					'Success'=> ''
    				));
    		}
    	}
}
?>