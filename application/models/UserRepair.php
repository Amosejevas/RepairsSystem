<?php
Class UserRepair extends CI_Model
{
  function getUserRepairsIds($userId){
    $user = $this->User->getUserId($this->session->userdata('username'));
    $userId = $user->row()->id;
    $this -> db -> select('repairId');
    $this -> db -> from('userRepairs');
    $this -> db -> where('userId', $userId);
    $query = $this -> db -> get();
    if($query -> num_rows() > 0) {
        return $query;
    } else {
        return false;
    }
  }
  function register($userId, $repairId) {
    $data=array(
      'userId' => $userId,
      'repairId' => $repairId
    );
    $this->db->insert('userRepairs', $data);
  }
}
?>