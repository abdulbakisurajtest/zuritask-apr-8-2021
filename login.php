<?php
include ('functions.php');
$error = "";
if(isset($_POST['login']))
{
	$error = loginUser($_POST['username'], $_POST['password']);
	if($error === TRUE)
	{
		header('Location: index.php');
		exit(0);
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
</head>
<body>
	<h1>Zuri Task - 2021/04/08</h1>
	<form method="post" action="login.php">
		<h2>Login Form</h2>
		<p style="color: red;">
			<?php
			if(!empty($error))
			{
				echo $error;
			}
			?>
		</p>
		<label>
			<p>
				Username:<br/>
				<input type="text" name="username" required>
			</p>
		</label>
		<label>
			<p>
				Password:<br/>
				<input type="password" name="password" required>
			</p>
		</label>
		<p>
			<button type="submit" name="login">Login</button>
		</p>
		<p>
			Don't have an account? <a href="register.php">Register</a>
		</p>
</body>
</html>