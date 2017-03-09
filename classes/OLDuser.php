<?php
//Schema
//users (user_id, first_name, last_name, birth_date)
//user_login(login_id, user_id, email_address, password_hash)
class User
{
	private $userID;
	public $mysqli;//I don't like that this is public.
	public $firstName;
	public $lastName;
	public $birthDate;
	public $emailAddress;//Should personal info be set to private?
	public $password;
	private $passwordHash;

	public function __construct($userID)
	{
	    $this->userID = $userID;

	    if ($userID > 0) {
	    	loadUser($userID);
	    }
	}

	public function save()
	{
		if ($this->userID == 0) {
			/*$this->userID =*/createUserInDatabase();

		} else {
			updateUserInDatabase();
		}
	}
	
	private function createUserInDatabase()
	{
		$bool = true;
		$sql = "SELECT email_address FROM user_login";
		$result = $this->mysqli->query($sql);

		if ($result->num_rows > 0) {
			
			while ($row = $result->fetch_assoc()) {
				$tablesEmailAddress = $row['email_address'];

				if ($tablesEmailAddress == $this->emailAddress) {
					$bool = false;
				}
			}

			if ($bool) {

				$this->mysqli->query("INSERT INTO users (first_name, last_name, birth_date) VALUES ('$this->firstName', '$this->lastName', '$this->birth_date')");
				$this->userID = mysqli_insert_id($mysqli);
				$this->mysqli->query("INSERT INTO user_login (user_id, email_address, password_hash) VALUES ('$this->userID', '$this->emailAddress', '$this->passwordHash')");

			}
			return $bool;
		}
	}

	private function updateUserInDatabase()
	{
		$bool = true;
		$result = $this->mysqli->query("SELECT email_address FROM user_login");

		if ($result->num_rows > 0) {
			
			while ($row = $result->fetch_assoc()) {
				$tablesEmailAddress = $row['emailAddress'];

				if ($tablesEmailAddress == $this->emailAddress) {
					$bool = false;
				}
			}

			if ($bool) {
			    $this->mysqli->query("UPDATE users SET first_name = '$this->firstName', last_name = '$this->lastName', birth_date = '$this->birthDate' WHERE user_id = '$this->userID'");
			    $this->myslqi->query("UPDATE user_login SET email_address = '$this->emailAddress', password_hash = '$this->passwordHash");
			}
			return $bool;
		}
	}

	public function loadUser()
	{
		$sql = "SELECT users.first_name, users.last_name, users.birth_date, user_login.email_address, user_login.password_hash FROM users INNER JOIN user_login ON users.user_id = user_login.user_id WHERE user_id = $this->userID";
		$result = $this->mysqli->query($sql);

		if ($result->num_rows > 0) {
			$this->firstName = $row['first_name'];
			$this->lastName = $row['last_name'];
			$this->birthDate = $row['birth_date'];
			$this->emailAddress = $row['email_address'];
			$this->passwordHash = $row['password_hash'];
		}

	}

	public function deleteUser()
	{
		$this->mysqli->query("DELETE FROM users WHERE user_id = '$this->userID'");
		$this->mysqli->query("DELETE FROM user_login WHERE user_id = '$this->userID'");
	}

	private function hashUserPassword($password)
	{
		/*//do I need this check here?
		if (strlen($password) < 8 || strlen($password) >32) {
			//return $password = "";
		}*/
		$this->passwordHash = password_hash($password, PASSWORD_DEFAULT);
		return $this->passwordHash;
	}

}

?>