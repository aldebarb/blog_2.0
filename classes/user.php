<?php
//Schema
//users (user_id, first_name, last_name, birth_date)
//user_login(login_id, user_id, email_address, password_hash)

class User
{
	private $userID;
	public $firstName;
	public $lastName;
	public $birthDate;
	public $emailAddress;//Should personal info should be private?
	public $password;

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
			$this->userID = createUserInDatabase();
		} else {
			updateUserInDatabase();
		}
	}
	
	private function createUserInDatabase()
	{
		
	}

}

?>