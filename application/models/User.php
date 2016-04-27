<?php 

class User extends CI_Model {

	public function get_user($info){
		$query = "SELECT users.first_name, users.last_name, users.email, users.id FROM users WHERE email = ? AND password = ?;";
		$user = [$info['email'], $info['password']];
		return $this->db->query($query, $user)->row_array();
	}

	public function add_user($user_info){
		$query = "INSERT INTO users(first_name, last_name, email, password, created_on, updated_on) VALUES(?,?,?,?, now(), now());";
		$query2 = "SELECT users.first_name, users.last_name, users.email, users.id FROM users WHERE email = ?;";
		$pass = 
		$user = [$user_info['first_name'], $user_info['last_name'], $user_info['email2'], $user_info['password2']];
		$user2 = [$user_info['email2']]; 
		if($this->db->query($query2, $user2)->row_array() == null){
			$this->db->query($query, $user);
			return $this->db->query($query2, $user2)->row_array();
		}
		else {
			return FALSE;
		}
	}
}
 ?>