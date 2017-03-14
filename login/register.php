<?php 
require '../includes/config.php';
require '../includes/formUtility.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registers</title>
</head>
<body>

<?php
if (isset($_POST['submit'])) {
	$inputArray = array_map('removeMaliciousCode', $_POST);
	$inputArray['firstName'] = checkStringLength($inputArray['firstName'], 32);
	$inputArray['lastName'] = checkStringLength($inputArray['lastName'], 32);
    //Need a function to check the date.
	$inputArray['emailAddress'] = verifyEmail($inputArray['emailAddress']);
	$inputArray['passwordHash'] = hashUserPassword($inputArray['password']);

    if (!$userLoggedIn->registerEmailAddress($inputArray['emailAddress'])) {
    	echo "Enter in the correct information.";
    
    } else {
        $registerUser = new User(0);
        $registerUser->firstName = $inputArray['firstName'];
        $registerUser->lastName = $inputArray['lastName'];
        $registerUser->birthDate = $inputArray['birthDate'];
        $registerUser->emailAddress = strtolower($inputArray['emailAddress']);
        $registerUser->passwordHash = $inputArray['passwordHash'];
        
        if ($registerUser->save($mysqli)) {
        	Print '<script>alert("Registration Complete!");</script>';
            Print '<script>window.location.assign("index.php");</script>';
            
        }
    }
}
?>

<h2>Enter your infromation</h2>

<form method="post" action="">
	First Name: <input type="text" name="firstName" value=""><br><br>
	Last Name: <input type="text" name="lastName" value=""><br><br>
	Birth Date: <input type="text" name="birthDate" value=""> mm/dd/yyyy<br><br>
	Email Address: <input type="text" name="emailAddress" value=""><br><br>
	Password: <input type="text" name="password" value=""><br><br>
	<input type="submit" name="submit" value="Submit">	
</form>

</body>
</html>