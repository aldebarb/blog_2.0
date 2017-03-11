<?php
//Schema
//users (user_id, first_name, last_name, birth_date)
//user_login(login_id, user_id, email_address, password_hash)
class UserLogin
{
	private $mysqli;
	public $userId;

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
		$sql = "SELECT user_id, password_hash FROM user_login WHERE email_address = '$emailAddress'";
		$result = $this->mysqli->query($sql);

		if ($result->num_rows > 0) {
			
			while ($row = $result->fetch_assoc()) {
				$this->userId = $row['user_id'];
				return $row['password_hash'];
			}

		} else {
			//Handle error?
		}
	}

	public function login($emailAddress, $password)
	{
		$hashed = $this->getUserHash($emailAddress);

		if (password_verify($password, $hashed) == 1) {
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