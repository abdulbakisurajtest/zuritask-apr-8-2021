<?php

// Register a new user
function registerUser($firstName, $lastName, $username, $password)
{
	// VALIDATE USER INFORMATION
		
		// check if first name is a valid string, else return an error
		// check if last name is a valid string, else return an error
		// check if username is a valid string, else return an error
		// check if password has a valid length, else return an error

	// SAVE USER INFORMATION
		
		// convert user information into this format (first|last|username|password)
		// open file in read mode, else return an error
		// for each line in file, check if formatted user string matches any line.
		// if there is a match
			// convert string to array
			// check if username index of array is the same with new username
			// return error if it matches
		// if there is no match
			// save formatted string to file on a new lin, else return an error

	// RETURN SUCCESS MESSAGE
}

// Log in user
function loginUser($username, $password)
{
	// VALIDATE USER INFORMATION
		
		// check if first name is a valid string, else return an error
		// check if last name is a valid string, else return an error
		// check if username is a valid string, else return an error
		// check if password has a valid length, else return an error

	// CHECK IF USER INFORMATION HAS A MATCH
		
		// open file in read mode, else return an error
		// for each line in file:
			// convert into an array
			// check if username and password match
			// if there is no match, return ERROR
			// if there is a match
				// set session variables for user
				// return SUCCESS
}

// Log out user
function logoutUser()
{
	// unset session variables for user
}

// Check if user is logged in
function checkLogin()
{
	// check if a session is started, else return FALSE
	// check if session variables is set, else return FALSE
	// return TRUE if no error
}

// Reset password
function resetPassword($firstName, $lastName, $username, $oldPassword, $newPassword)
{
	// VALIDATE USER INFORMATION
		
		// check if first name is a valid string, else return an error
		// check if last name is a valid string, else return an error
		// check if username is a valid string, else return an error
		// check if old password has a valid length, else return an error
		// check if new password has a valid length, else return an error

	// CHECK IF USER IS VALID
		
		// convert old user information into this format (first|last|username|oldpassword)
		// convert new user information into this format (first|last|username|newpassword)
		// open file in read mode, else return an error
		// for each line in file, check if old user information (formatted) matches any line.
		// if there is a match
			// delete line
			// save new user information (formatted)
		// if there is no match
			// return ERROR
}



/* SOME USEFUL SCRIPTS */

// read from file
$users = array();
$counter = 0;
$fileName = 'user_info.txt';
$file = fopen($fileName, "r");
if ($file) {
    while(!feof($file))
    {
        $line = explode("|", fgets($file));
        $users[$counter]['name'] = $line[0];
        $users[$counter]['password'] = $line[1];
        $counter++;
    }
}
$counter = 0;

// write to file
$file = fopen($fileName, "a");
$new_user = 'New_user|New_user_key';
fwrite($file, "\n".$new_user);

// replace password in file
	// open file in read mode
	// initialize an array to store information
	// for each line in file, use explode() function to store it in the initialized array
	// looping through the array index of array, locate index where username and password matches and then replace the password
	// close the file
	// open the file in write mode
	// for each index in array, use implode() function  to convert to string
	// WRITE TO THE FILE
	// close the file
