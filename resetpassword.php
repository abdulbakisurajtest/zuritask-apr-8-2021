<?php
session_start();
include('functions.php');
// check if user is logged in
checkLogin();
$message = '';

if(isset($_POST['reset_password']))
{
	$message = resetPassword($_SESSION['user']['first_name'], $_SESSION['user']['last_name'], $_SESSION['user']['username'], $_POST['old_password'], $_POST['new_password']);
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reset Password</title>
</head>
<body>
	<h1>Zuri Task - 2021/04/08</h1>
	<form method="post" action="resetPassword.php">
		<h2>Reset Password</h2>
		<p style="color: red;">
			<?php
			if(!empty($message))
			{
				echo $message;
			}
			?>
		</p>
		<label>
			<p>
				Old password:<br/>
				<input type="text" name="old_password">
			</p>
		</label>
		<label>
			<p>
				New password:<br/>
				<input type="new_password" name="password">
			</p>
		</label>
		<p>
			<a href="index.php">Cancel</a>&nbsp;&nbsp;<button type="submit" name="login">Change</button>
		</p>
</body>
</html>