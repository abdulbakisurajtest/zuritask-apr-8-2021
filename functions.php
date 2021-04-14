<?php
// Register a new user
function registerUser($firstName, $lastName, $username, $password)
{
	$fileName = "user_info.txt";
	$fileSize = filesize($fileName);
	
	// VALIDATE USER INFORMATION
		
		// check if first name is a valid string, else return an error
		if(!isNameValid($firstName))
		{
			return 'First name is invalid';
		}

		// check if last name is a valid string, else return an error
		if(!isNameValid($lastName))
		{
			return 'Last name is invalid';
		}
		
		// check if username is a valid string, else return an error
		if(!isNameValid($username))
		{
			return 'Username is invalid';
		}
		
		// check if password has a valid length, else return an error
		if(!isPasswordValid($password))
		{
			return 'Password is invalid';
		}

	// SAVE USER INFORMATION

		// convert user information into this format (first|last|username|password)
		$user_information = $firstName.'|'.$lastName.'|'.$username.'|'.$password;
	
		// open file in read mode, else return an error
		$fp = fopen($fileName, "r");
		if($fp)
		{
			// for each line in file, check if formatted user string matches any line.
		    while(!feof($fp))
		    {
		    	// format single line into an array
		        $line = explode("|", fgets($fp));
		        
		        // if array indexes is less than 4 (i.e empty space)
		        if(count($line) < 4)
		        {
		        	// skip loop
		        	continue;
		        }

		        // if there is a match
		        if($line[2] === $username)
		        {
		        	return 'Username already exists';
		        }
		    }
		}else
		{
			return 'Error accessing user database(1)';
		}
		fclose($fp);

		// if there is no match
		// save formatted string to file on a new line, else return an error
		$fp = fopen($fileName, "a");
		if($fp)
		{
			fwrite($fp, "\n".$user_information);
			return TRUE;

		}else
		{
			return 'Error accessing user database(2)';
		}
		fclose($fp);

		// LOGIN USER		
}

// Log in user
function loginUser($username, $password)
{
	session_start();	// start a session

	$fileName = "user_info.txt";
	$fileSize = filesize($fileName);

	// VALIDATE USER INFORMATION
		
		// check if username is a valid string, else return an error
		if(!isNameValid($username))
		{
			return 'Username is invalid';
		}
		
		// check if password has a valid length, else return an error
		if(!isPasswordValid($password))
		{
			return 'Password is invalid';
		}

	// CHECK IF USER INFORMATION HAS A MATCH
		
		// open file in read mode, else return an error
		$fp = fopen($fileName, "r");
		if($fp)
		{
			// for each line in file:
		    while(!feof($fp))
		    {
				// convert string into an array
		        $line = str_replace(array("\r", "\n", "\s"), '', fgets($fp));
		        $line = explode("|", $line);

		        // if array indexes is greater than 3
		        if(count($line)>3)
		        {
					// check if username match
			        if($line[2] === $username)
			        {
			        	// check if password match
			        	if($line[3] === $password)
						{
							// if there is a match, set session variables for user
						    $_SESSION['user']['first_name'] = $line[0];
						    $_SESSION['user']['last_name'] = $line[1];
						    $_SESSION['user']['username'] = $line[2];
						    return TRUE;
						}
						else
						{
							return 'Incorrect password';
						}
			        }
		        }
		        else 	// if array indexes is less than 4
		        {
		        	// skip loop
		        	continue;
		        }
		    }

			// if there is no such username, return error
			session_destroy();
		    return 'User not found';
		}
		else
		{
			return 'Error accessing user database(1.1)';
		}
		fclose($fp);
}

// Check if user is logged in
function checkLogin()
{
	// check if session variables is set, else redirect to login page
	if(!isset($_SESSION['user']['first_name']) || !isset($_SESSION['user']['last_name']) || !isset($_SESSION['user']['username']))
	{
		header('Location: login.php');
		exit(0);
	}
}

// Reset password
function resetPassword($firstName, $lastName, $username, $oldPassword, $newPassword)
{
	$fileName = "user_info.txt";
	$fileSize = filesize($fileName);

	// VALIDATE USER INFORMATION
		
		// check if first name is a valid string, else return an error
		if(!isNameValid($firstName))
		{
			return 'First name is invalid';
		}

		// check if last name is a valid string, else return an error
		if(!isNameValid($lastName))
		{
			return 'Last name is invalid';
		}
		
		// check if username is a valid string, else return an error
		if(!isNameValid($username))
		{
			return 'Username is invalid';
		}
		
		// check if old password has a valid length, else return an error
		if(!isPasswordValid($oldPassword))
		{
			return 'Old password is invalid';
		}

		// check if new password has a valid length, else return an error
		if(!isPasswordValid($newPassword))
		{
			return 'New password is invalid';
		}


	// CHECK IF USER IS VALID
		
		// convert old user information into this format (first|last|username|oldpassword)
		$oldUserInformation = $firstName.'|'.$lastName.'|'.$username.'|'.$oldPassword;

		// convert new user information into this format (first|last|username|newpassword)
		$newUserInformation = $firstName.'|'.$lastName.'|'.$username.'|'.$newPassword;


		$allUserInfo = array();
		$counter = 0;
		
		// open file in read mode, else return an error
		$fp = fopen($fileName, 'r');
		if($fp && ($fileSize>0))
		{
			while(!feof($fp))
			{
				// convert the whole file into an array with each line as an index
				$line = str_replace(array("\r", "\n", "\s"), '', fgets($fp));
				$allUserInfo[$counter] = $line;
				$counter++;
			}
			$newAllUserInfo = $allUserInfo;
			fclose($fp);
		}
		else{
			return 'Error accessing database(3)';
		}

		// loop through the user information array
		for($i=0; $i<count($allUserInfo); $i++)
		{
			// if there is an index that matches the old user information
			if($allUserInfo[$i] === $oldUserInformation)
			{
				// replace with new user information (formatted)
				$newAllUserInfo[$i] = $newUserInformation;

				// open file in write mode
				$fp = fopen($fileName, 'w');
				$fp = fclose($fp);
				$fp = fopen($fileName, 'a');
				if($fp && ($fileSize>0))
				{
					// for each index in array, save as a line in the file
					for($i=0; $i<count($newAllUserInfo); $i++)
					{
					
						// write to file
						fwrite($fp, "\n".$newAllUserInfo[$i]);
					}
					fclose($fp);
					return 'success';
				}
				else{
					return 'Error accessing database(4)';
				}
			}
		}
		// if there is no match return ERROR
		return 'Incorrect old password';
}

// Validate name
function isNameValid($name)
{
	// initialize return variable to true
	$validity = TRUE;
	// remove whitespaces
	$name = trim($name);
	// check if name is empty
	if(empty($name))
	{
		$validity = FALSE;
	}
	// ensure name length is greater than one
	if(strlen($name)<2)
	{
		$validity = FALSE;
	}

	// other checks can be performed here

	return $validity;
}

// Validate password
function isPasswordValid($password)
{
	// initialize return variable to true
	$validity = TRUE;
	// remove whitespaces
	$password = trim($password);
	// ensure password length is greater than 7
	if(strlen($password)<8)
	{
		$validity = FALSE;
	}

	// other checks can be performed here

	return $validity;
}

// Display previously filled values in form input
function displayValue($name)
{
	if(isset($_POST[$name]) && !empty($_POST[$name]))
	{
		echo $_POST[$name];
	}
}
?>