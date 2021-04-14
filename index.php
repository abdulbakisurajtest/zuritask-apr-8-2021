<?php
session_start();
include('functions.php');
// check if user is logged in
checkLogin();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Zuri Task | 2021-04-08</title>
</head>
<body>
	<h1>Zuri Task - 2021/04/08</h1>
	<p>
		Welcome, 
		<?php
		echo htmlentities($_SESSION['user']['first_name']);
		echo ' '.htmlentities($_SESSION['user']['last_name']);
		echo '<strong>';
		echo ' @'.htmlentities($_SESSION['user']['username']);
		echo '</strong>';
		?>
	</p>
	<p>
		<a href="logout.php">Logout</a> or <a href="resetpassword.php">Reset password</a>
	</p>

</body>
</html>