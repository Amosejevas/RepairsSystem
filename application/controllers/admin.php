<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {
	function __construct()
    {
        parent::__construct();
    }

	public function Repairs(){
		$editForm = null;
		$doEdit = FALSE;
		if(!isset($_SESSION['Repairsfilter'])){
			$this->session->set_userdata('Repairsfilter', '');
		}
		$this->session->set_userdata('orderRepairsType', 'repairId');
		if(!isset($_SESSION['orderRepairsType'])){
			$this->session->set_userdata('orderRepairsType', 'repairId');
		}
		if(!isset($_SESSION['order'])){
			$this->session->set_userdata('order', 'ASC');
		}
		if (!empty($_POST['buttonDelete'])) {
			$repairId = $this->input->post('repairId');
			$this->Repair->delete($repairId);
		}
		if (!empty($_POST['buttonEdit'])) {
			$repairId = $this->input->post('repairId');
			$result = $this->Repair->getById($repairId);
			$editForm = $this->load->view('EditRepairView', array(
					'id' => $repairId,
					'type' => $result->type,
					'serial' => $result->serial,
					'device' => $result->device,
					'description' => $result->description,
					'status' => $result->status,
					'isAccepted' => $result->isAccepted
				), TRUE);
			$doEdit = TRUE;
		}
		if (!empty($_POST['finishEdit'])) {
			$repairId = $this->input->post('repairId');
			$type = $this->input->post('type');
			$serial = $this->input->post('serial');
			$device = $this->input->post('device');
			$description = $this->input->post('description');
			$status = $this->input->post('status');
			$isAccepted = $this->input->post('isAccepted');
			$this->Repair->updateRepair($repairId, $type, $serial, $device, $description, $status, $isAccepted);
		}
		if (!empty($_POST['buttonOrderBy'])) {
			$orderType = $this->input->post('orderByTypeDropdown');
			$order = $this->input->post('orderByDropdown');
			$this->session->set_userdata('orderRepairsType', $orderType);
			$this->session->set_userdata('order', $order);
		}
		if (!empty($_POST['buttonFilterBy'])) {
			$filter = $this->input->post('filter');
			$this->session->set_userdata('Repairsfilter', $filter);
		}
		// $this->Repair->updateRepair($id, $type, $serial, $device, $description, $status, $isAccepted);
		$repairList = $this->Repair->getAllRepairs($_SESSION['orderRepairsType'], $_SESSION['order'], $_SESSION['Repairsfilter']);
		$result = $repairList->result_array();
		$this->load->view('RepairsDashboardView', array(
				'repairList' => $result,
				'doEdit' => $doEdit,
				'editRepair' => $editForm
			));
	}


	public function Users() {
		$isEditNeeded = FALSE;
		$isCreateNeeded = FALSE;
		$createForm = null;
		$editForm = null;
		if(!isset($_SESSION['Usersfilter'])){
			$this->session->set_userdata('Usersfilter', '');
		}
		if(!isset($_SESSION['orderType'])){
			$this->session->set_userdata('orderType', 'id');
		}
		if(!isset($_SESSION['order'])){
			$this->session->set_userdata('order', 'ASC');
		}
		if (!empty($_POST['buttonDelete'])) {
			$userId = $this->input->post('userId');
			$this->User->delete($userId);
		}
		if (!empty($_POST['buttonClear'])) {
			$this->session->set_userdata('Usersfilter', '');
		}
		if (!empty($_POST['buttonBlock'])) {
			$userId = $this->input->post('userId');
			$this->User->block($userId, 'Improper nickname');
		}
		if (!empty($_POST['buttonCreate'])) {
			$isCreateNeeded = TRUE;
			$createForm = $this->load->view('createUserView', array(), TRUE);
		}
		if (!empty($_POST['buttonEdit'])) {
			$userId = $this->input->post('userId');
			$result = $this->User->getById($userId);
			$editForm = $this->load->view('EditUserView', array(
					'id' => $userId,
					'username' => $result->username,
					'email' => $result->email,
					'role' => $result->roleId
				), TRUE);
			$isEditNeeded = TRUE;
		}
		if (!empty($_POST['finishEdit'])) {
			$userId = $this->input->post('userId');
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$role = $this->input->post('role');
			$this->User->updateUser($userId, $username, $email, $role);
		}
		if (!empty($_POST['createUser'])) {
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$role = $this->input->post('role');
			$password = $this->input->post('password');
			$this->User->register($username, $email, $password ,$role);
		}
		if (!empty($_POST['buttonOrderBy'])) {
			$orderType = $this->input->post('orderByTypeDropdown');
			$order = $this->input->post('orderByDropdown');
			$this->session->set_userdata('orderType', $orderType);
			$this->session->set_userdata('order', $order);
		}
		if (!empty($_POST['buttonFilterBy'])) {
			$filter = $this->input->post('filter');
			$this->session->set_userdata('Usersfilter', $filter);
		}

		$userList = $this->User->getAllUsers($_SESSION['orderType'], $_SESSION['order'], $_SESSION['Usersfilter']);
		$result = $userList->result_array();
		$form = $this->load->view('UsersDashboardView', array(
				'userList' => $result
			), true);
		$this->load->view('adminLayout', array(
			    'content' => $form,
			    'editForm' => $editForm,
			    'doEdit' => $isEditNeeded,
			    'doCreate' => $isCreateNeeded,
			    'createForm' => $createForm
			));
	}
}
?>