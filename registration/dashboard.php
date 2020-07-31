<?php
session_start();
if (!$_SESSION['username']) {
	header('location: login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>index.php</title>
</head>
<body>
	<div class="header">
	<h2>Home Page</h2>
</div>

<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>

<a href="logout.php"><span>Logout</span></a>

</body>
</html>