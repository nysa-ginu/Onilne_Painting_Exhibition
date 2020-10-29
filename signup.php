<?php
if (isset($_POST['signup-submit'])) {
	
	require 'dbh.php'; //connection in dbh is established

	$logid = $_POST['loginid'];
	$pass = $_POST['pwd'];
	$gen = $_POST['gender'];
	$emailid = $_POST['email'];

	$sql = "SELECT logidUser FROM users WHERE logidUser=?";

	$stmt = mysqli_init($conn);

	mysqli_stmt_bind_param($stmt, "s", $logid);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);

	$resultCheck = mysqli_stmt_num_rows($stmt);
	if ($resultCheck > 0) {
		header("Location: ../signup.html?error=usertaken");
		exit();
	}

	else
	{
		$sql = "INSERT INTO users (logidUser, pwdUser, gendUser, emailIdUser) VALUES (?,?,?,?)";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: ../signup.html?error=sqlerror");
		    exit();
		}
		else{
			mysqli_stmt_bind_param($stmt, "ssss", $logid, $pass, $gen, $emailid);
			mysqli_stmt_execute($stmt);
			header("Location: http://localhost/web/login.html");
		    exit();
		}
	}

	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}

?>
