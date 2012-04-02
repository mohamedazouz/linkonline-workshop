<?php 
/*
	Developed by :	  	Khalid Ahmed
	eMail :			 	contact@khalidpeace.com
	Web Site :		  	www.khalidpeace.com
	
	Created On : 		2009-06-03
	Last Modified :		2010-11-29
	
	---------------------------------------
	

	//basic members table structure :
		members
			email
			pass
			member_name
			... any other fields
			
	
	
	// login
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$remember_me = ($_POST['remember_me'] == 'yes') ? true : false;

	$result = $members->login($email, $pass, $remember_me);
	if ($result == false){
		$error_msg = 'Login Failed';
	}
	
	
	
	// logout
	$members->logout();
	
	
	
	
	// check state
	if ($members->is_logged){
		$member_name = $members->member_name;
		$member_admin = $members->data['admin'];
	} 
	
	
	
	
*/


class Cauth
{

	public $db;											// refer to db object used to access database

	public $is_logged = false;
	
	public $id = '';
	public $username = '';
	public $email = '';
	public $pass = '';
	public $data = array();						// contains all record fields
	
	
	// component configurations
	public $users_table = 'user';
	public $id_field = 'id';
	public $enable_verify = false;
	public $session_prefix = '';
	
	
	

	public function check_login($username,$pass)
	{
		$this->db->safeit($login);
		
		$sql = "SELECT * FROM {$this->users_table} WHERE  username='$username' AND pass = '$pass'";
		
		$data = $this->db->query($sql);
		
		if (sizeof($data) <> 1) return false;
		return $data[0];		// return all record data
	}



	public function login($username,$pass)
	{
		$result = $this->check_login($username,$pass);
		if (! $result) return false;

		$this->is_logged = true;		
		$this->id = $result[$this->id_field];
		$this->pass = $pass;
		$this->data = $result;

		// update last_access field
		// $sql = "UPDATE {$this->users_table} SET last_access = NOW() WHERE {$this->id_field} = {$this->id}";
		// $this->db->execute($sql);
		
		// save id to session
		$_SESSION[$this->session_prefix . 'logged'] = true;
		$_SESSION[$this->session_prefix . 'user_id'] = $this->id;
		
		if ($remember_me) {
			setcookie($this->session_prefix . 'logged', true, mktime(0,0,0,1,1,2030) );
			setcookie($this->session_prefix . 'user_id', $this->id, mktime(0,0,0,1,1,2030) );
		}		
	
		return true;
	}
	
	
	
	private function login_by_id ($id)
	{
		if (empty($id)) return false;

		$this->db->safeit($id);
		
		$sql = "SELECT * FROM {$this->users_table} WHERE {$this->id_field} = $id";
		
		$result = $this->db->query($sql);
		
		if (sizeof($result) <> 1) return false;
		$result = $result[0];
		
		$this->is_logged = true;		
		$this->id = $result[$this->id_field];
		$this->email = $result['email'];
		$this->username = $result['username'];
		$this->pass = $result['pass'];
		$this->data = $result;
		
		return true;
	}



	public function logout()
	{
		$this->is_logged = false;
		$this->id = '';
		$this->email = '';
		$this->username = '';
		$this->pass = '';
		$this->data = array();

		unset($_SESSION[$this->session_prefix . 'logged']);
		unset($_SESSION[$this->session_prefix . 'user_id']);
		
		setcookie($this->session_prefix . 'logged');
		setcookie($this->session_prefix . 'user_id');
	}



	public function start()
	{
		//check sessions
		session_start();

		if (isset($_SESSION[$this->session_prefix . 'logged'])){
			$user_id = $_SESSION[$this->session_prefix . 'user_id'];
			
			return $this->login_by_id($user_id);
		}
		
		// check if cookie exist, use it to login
		if ( (isset($_COOKIE[$this->session_prefix . 'user_id'])) and ($_COOKIE[$this->session_prefix . 'user_id'] != '') ) {
			$user_id = $_COOKIE[$this->session_prefix . 'user_id'];
			
			return $this->login_by_id($user_id);
		}
		
	}




}



?>