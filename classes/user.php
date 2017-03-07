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
	public $passwordHash;

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
					print '<script>alert("Email address has been taken.");</script>';
					print '<script>window.location.assign("register.php");</script>';
				}
			}

			if ($bool) {
				$this->mysqli->query("INSERT INTO users (first_name, last_name, birth_date) VALUES ('$this->firstName', '$this->lastName', '$this->birth_date')");
				$this->userID = mysqli_insert_id($mysqli);
				$this->mysqli->query("INSERT INTO user_login (user_id, email_address, password_hash) VALUES ('$this->userID', '$this->emailAddress', '$this->passwordHash')");

				print '<script>alert("Registration Complete!");</script>';
				print '<script>window.location.assign("index.php");</script>';
			}
		}
	}

	private function updateUserInDatabase()
	{
		$bool = true;
		$sql = "SELECT email_address FROM user_login";
		$result = $this->mysqli->query($sql);

		if ($result->num_rows > 0) {
			
			while ($row = $result->fetch_assoc()) {
				$tablesEmailAddress = $row['emailAddress'];

				if ($tablesEmailAddress == $this->emailAddress) {
					$bool = false;
					print '<script>alert("Email address has been taken.");</script>';
					print '<script>window.location.assign("register.php");</script>';
				}
			}

			if ($bool) {
			    $this->mysqli->query("UPDATE users SET first_name = '$this->firstName', last_name = '$this->lastName', birth_date = '$this->birthDate' WHERE user_id = '$this->userID'");
			    $this->myslqi->query("UPDATE user_login SET email_address = '$this->emailAddress', password_hash = '$this->passwordHash");
			    print '<script>alert("Update Successful!");</script>';
				print '<script>window.location.assign("index.php");</script>';
			}
		}
	}

	public function loadUser()
	{

	}

	public function deleteUser()
	{

	}

}

?>