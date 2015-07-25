<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_Reg extends CI_Model 
{
	// inserts a new user into the database upon registration
	function new_user($post)
	{	
		$password = md5($post['password']);
		$query = "INSERT INTO users (first_name, last_name, alias, email, password, created_at) VALUES (?,?,?,?,?,NOW())";
		$values = array($post['first_name'], $post['last_name'], $post['alias'], $post['email'], $password, date("Y-m-d H:i:s"));
		$this->db->query($query, $values);
		return mysql_insert_id();
	}

	// get a specific user
	function get_user($post)
	{
		$password = md5($post['password']);
		return $this->db->query("SELECT * FROM users WHERE email = ? AND password = ?", array($post['email'], $password)) -> row_array();
	}

	// gets all users
	public function get_all_users()
	{
		$query = "SELECT * FROM users";
		return $this->db->query($query) -> result_array();
	}

	// gets one user with the matching id
	public function get_one_user($id)
	{
		$query = "SELECT * FROM users WHERE id = ".$id;
		return $this->db->query($query)->row_array();
	}

	


}