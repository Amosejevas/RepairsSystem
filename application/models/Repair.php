<?php
Class Repair extends CI_Model
{

  function updateRepair($id, $type, $serial, $device, $description, $status, $isAccepted) {
      $this->db->set('type', $type);
      $this->db->set('serial', $serial);
      $this->db->set('device', $device);
      $this->db->set('description ', $description);
      $this->db->set('status', $status);
      $this->db->set('isAccepted', $isAccepted);
      $this->db->where('id', $id);
      $this->db->update('repairs');
  }

  function getById($id) {
    $this->db->select('*');
    $this->db->from('repairs');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  function delete($id) {
    $this->db->delete('repairs', array('id' => $id));
  }

  function getAllRepairs($orderType, $order, $match){
    $this->db->select('*');
    $this->db->from('repairs');
    $this -> db -> join('userRepairs', 'userRepairs.repairId = repairs.id');
    $this -> db -> join('users', 'users.id = userRepairs.userId');
    $this->db->where("                               (repairs.device LIKE '%{$match}%')
                                                 OR  (repairs.type LIKE '%{$match}%')
                                                 OR  (repairs.status LIKE '%{$match}%')
                                                 OR  (users.username LIKE '%{$match}%')");
    $this->db->order_by($orderType, $order);
    $query = $this->db->get();
    return $query;
  }

  function updateRepairStatus($repairId, $status) {
      $this->db->set('status', $status);
      $this->db->where('id', $repairId);
      $this->db->update('repairs');
  }

  function accept($repairId) {
    $this->db->set('isAccepted', 'Accepted');
    $this->db->where('id', $repairId);
    $this->db->update('repairs');
  }

  function decline($repairId) {
    $this->db->set('isAccepted', 'Declined');
    $this->db->where('id', $repairId);
    $this->db->update('repairs');
  }

  function getUserRepairs($name, $match){
    $this -> db -> select('repairs.*, users.*, userRepairs.*');
    $this -> db -> from('repairs');
    $this -> db -> join('userRepairs', 'userRepairs.repairId = repairs.id');
    $this -> db -> join('users', 'users.id = userRepairs.userId');
    $this->db->where("users.username = '{$name}' AND ((repairs.device LIKE '%{$match}%')
                                                 OR  (repairs.type LIKE '%{$match}%')
                                                 OR  (repairs.status LIKE '%{$match}%')
                                                 OR  (users.username LIKE '%{$match}%')
                    )");
    $query = $this -> db -> get();
        return $query;
  }
  function getAllRepairsFiltered($match){
    $this -> db -> select('repairs.*, users.*, userRepairs.*');
    $this -> db -> from('repairs');
    $this -> db -> join('userRepairs', 'userRepairs.repairId = repairs.id');
    $this -> db -> join('users', 'users.id = userRepairs.userId');
    $this->db->where("                               ((repairs.device LIKE '%{$match}%')
                                                 OR  (repairs.type LIKE '%{$match}%')
                                                 OR  (repairs.status LIKE '%{$match}%')
                                                 OR  (users.username LIKE '%{$match}%')
                    )");
    $query = $this -> db -> get();
    if($query -> num_rows() > 0) {
        return $query;
    } else {
        return $query;
    }
  }
  function register($type, $serial, $device, $description) {
    $data=array(
      'type' => $type,
      'serial' => $serial,
      'device' => $device,
      'description' => $description,
      'status' => 'New',
      'date' => date("Y-m-d H:i:s")
    );
    $this->db->insert('repairs', $data);
  }
}
?>