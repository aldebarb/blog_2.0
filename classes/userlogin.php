<?php
//Schema
//users (user_id, first_name, last_name, birth_date)
//user_login(login_id, user_id, email_address, password_hash)
class UserLogin
{
	private $mysqli;

	function __construct($mysqli)
	{
		$this->mysqli = $mysqli;
	}

	public function isLoggedIn()
	{
		if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
			return true;
		}
	}

	private function getUserHash($emailAddress)
	{
		$sql = "SELECT password FROM users WHERE emailAddress = $emailAddress";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			
			while ($row = $result->fetch_assoc()) {
				return $row['password'];
			}
		} else {
			//Handle error?
		}
	}

	public function login($emailAddress, $password)
	{
		$hashed = $this->getUserHash($emailAddress);

		if ($this->password_verify($password, $hashed) == 1) {
			$_SESSION['loggedIn'] = true;
			return true;
		}
	}

	public function logout()
	{
		session_destroy();
	}

}

?>