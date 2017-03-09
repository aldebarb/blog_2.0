<?php
//Schema
//users (user_id, first_name, last_name, birth_date)
//user_login(login_id, user_id, email_address, password_hash)
class User
{
	private $userId;
	private $passwordHash;
	public $firstName;
	public $lastName;
	public $birthDate;
	public $emailAddress;
	public $password;
	

	public function __construct($userId)
	{
		$this->userId = $userId;

		if ($userId >0) {
			loadUser($userId);
		}
	}

	public function save($mysqli)
	{
		if ($this->userId == 0) {
	        $this->createUserInDatabase($mysqli);
	        
		} else {
			$this->updateUserInDatabase($mysqli);
		}
	}

	private function createUserInDatabase($mysqli)
	{
		$this->hashUserPassword();

        $mysqli->query("INSERT INTO users (first_name, last_name, birth_date) VALUES ('$this->firstName', '$this->lastName', '$this->birthDate')");
        $this->userId = mysqli_insert_id($mysqli);
        $mysqli->query("INSERT INTO user_login (user_id, email_address, password_hash) VALUES ('$this->userId', '$this->emailAddres', '$this->passwordHash')");
        //return true; //May not need this
	}

	private function updateUserInDatabase($mysqli)
	{
		$this->hashUserPassword();
		
		$mysqli->query("UPDATE users SET first_name = '$this->firstName', last_name = '$this->lastName', birth_date = '$this->birthDate' WHERE user_id = '$this->userId'");
		$mysqli->query("UPDATE user_login SET email_address = '$this->emailAddress', password_hash = $this->passwordHash")
	}
	
	public function deleteUser($mysqli)
	{
		$mysqli->query("DELETE FROM users WHERE user_id = '$this->userId'");
		$mysqli->query("DELETE FROM user_login WHERE user_id = '$this->userId'");
	}

	public function loadUser($mysqli)
	{
		$sql = "SELECT users.first_name, users.last_name, users.birth_date, user_login.email_address, user_login.password_hash FROM users INNER JOIN user_login ON users.user_id = user_login.user_id WHERE user_id = '$this->userId'";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$this->firstName = $row['first_name'];
			$this->lastName = $row['last_name'];
			$this->birthDate = $row['birth_date'];
			$this->emailAddress = $row['email_address'];
			$this->passwordHash = $row['password_hash'];
		}
	}

    private function hashUserPassword()
    {
    	$this->passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
    	return $this->passwordHash;
    }

}

?>