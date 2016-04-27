<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Quotable extends CI_Model {
	

	//This function adds a new user when they register. It checks first if the username being registered is already in use or not.
	public function add_user($user_info){
		$query = "INSERT INTO users(name, alias, email, password, birthdate, created_on, updated_on) VALUES(?, ?, ?, ?, ?, now(), now())";
		$user = [$user_info['name'], $user_info['alias'], $user_info['email'], $user_info['password'], $user_info['birthdate']];
		$query2 = "SELECT alias, id, name FROM users WHERE email = ?;";
		$user2 = [$user_info['email']]; 
		if($this->db->query($query2, $user2)->row_array() == null){
			$this->db->query($query, $user);
			return $this->db->query($query2, $user2)->row_array();
		}
		else {
			return FALSE;
		}
	}	

	//This function allows the user to sign in by checking their username and password against the informaiton stored in the users table of the DB.
	public function signin($user_info){
		$query = "SELECT id, name, alias FROM users WHERE email = ? AND password = ?";
		$user = [$user_info['email2'], $user_info['password2']];
		return $this->db->query($query, $user)->row_array();
	}


	public function get_favorites ($id){
		$query = "SELECT quotes.id AS quotes_id, quoted_by, quote, posted_by_id, alias FROM quotes JOIN users ON users.id = quotes.posted_by_id JOIN favorites ON favorites.quote_id = quotes.id WHERE favorites.user_id = ?";
		$info = [$id];
		return $this->db->query($query, $info)->result_array();

	}

	public function get_quotelist($id){
		$query = "SELECT quotes.id AS quotes_id, quoted_by, quote, posted_by_id, alias FROM quotes LEFT JOIN users ON users.id = quotes.posted_by_id WHERE NOT quotes.id IN (select quotes.id FROM quotes  LEFT JOIN favorites on favorites.quote_id = quotes.id LEFT JOIN users ON favorites.user_id = users.id WHERE favorites.user_id = ?)";
		$info = [$id];
		return $this->db->query($query, $info)->result_array();
	}

	public function add_favorite ($user_id, $quote_id) {
		$query = "INSERT INTO favorites(user_id, quote_id) VALUES(?, ?)";
		$info = [$user_id, $quote_id];
		$this->db->query($query, $info);
	}

	public function remove_favorite ($user_id, $quote_id) {
		$query = "DELETE FROM favorites WHERE user_id = ? AND quote_id = ?";
		$info = [$user_id, $quote_id];
		$this->db->query($query, $info);
	}

	public function add_quote($new_quote){
		$query = "INSERT INTO quotes(quoted_by, quote, posted_by_id, created_on, updated_on) VALUES(?, ?, ?, now(), now())";
		$info = [$new_quote['quoted_by'], $new_quote['quote'], $new_quote['posted_by_id']];
		$this->db->query($query, $info);
	}

	public function get_user_quotes($id){
		$query = "SELECT quotes.id AS quotes_id, quoted_by, quote, posted_by_id, alias FROM quotes  LEFT JOIN users ON quotes.posted_by_id = users.id WHERE posted_by_id = ?";
		$info = [$id];
		return $this->db->query($query, $info)->result_array();
	}



}


 ?>