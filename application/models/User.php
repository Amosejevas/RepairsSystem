<?php
Class User extends CI_Model {

   function updateUser($id, $username, $email, $role) {
      $this->db->set('username', $username);
      $this->db->set('email', $email);
      $this->db->set('roleId', $role);
      $this->db->where('id', $id);
      $this->db->update('users');
  }

  function getById($id) {
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  function getAllUsers($orderType, $order, $match){
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where("     (id   LIKE '%{$match}%')
                       OR  (username     LIKE '%{$match}%')
                       OR  (email   LIKE '%{$match}%')
                       OR  (roleId LIKE '%{$match}%')
    ");
    $this->db->order_by($orderType, $order);
    $query = $this->db->get();
    return $query;
  }

  function delete($userId) {
    $this->db->delete('users', array('id' => $userId));
  }
  function block($userId, $reason) {
    $data=array(
      'userId' => $userId,
      'reason' => $reason
    );
    $this->db->insert('blocks', $data);
  }

 function getUserRole($username) {
  $this->db->select('users.username, roles.name');
  $this->db->from('roles');
  $this->db->join('users', 'users.roleId = roles.id');
  $this->db->where('users.username', $username);
  $query = $this->db->get();
  $result = $query->row()->name;
  return $result;
 }

 function getUserId($userName) {
  $this -> db -> select('id');
  $this -> db -> from('users');
  $this -> db -> where('username', $userName);
  $this -> db -> limit(1);
  $query = $this -> db -> get();
  if($query -> num_rows() == 1) {
     return $query;
   } else {
     return false;
   }
 }
 function login($username, $password)
 {
   $this -> db -> select('id, username, password');
   $this -> db -> from('users');
   $this -> db -> where('username', $username);
   $this -> db -> where('password', MD5($password));
   $this -> db -> limit(1);
 
   $query = $this -> db -> get();
 
   if($query -> num_rows() == 1) {
     return $query->result();
   } else {
     return false;
   }
 }
  function register($username, $email, $password, $role_id) {
    $data=array(
      'roleId' => $role_id,
      'email' => $email,
      'username' => $username,
      'password' => md5($password)
    );
    $this->db->insert('users', $data);
  }
}
?>