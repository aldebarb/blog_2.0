<?php
function removeMaliciousCode($data)
{
	$data = implode("", explode("\\", $data));
	$data = trim($data);
	$data = stripslashes($data);
	return $data;
}

function checkStringLength($userString, $stringLength)
{
    if(empty($userString) || strlen($userString) > $stringLength || !preg_match("/^[a-zA-Z ]*$/", $userString)) {
    	return "";
    }
    return $userString;
}

function verifyEmail($userEmail)
{
	if(empty($userEmail) || strlen($userEmail) >254 || !filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
		return "";
	}
	return $userEmail;
}
function hashUserPassword($password)
    {
    	if (strlen($password) < 8 || strlen($password) > 32) {
		    return $passwordHash = "";
	    }

    	$passwordHash = password_hash($password, PASSWORD_DEFAULT);
    	return $passwordHash;
    }
