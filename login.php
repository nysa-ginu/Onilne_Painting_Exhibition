<?php

if (isset($_POST['login-submit'])) {

	require 'dbh.php'; //connection in dbh is established

	$logid = $_POST['loginid'];
	$pass = $_POST['pwd'];

	$sql = "SELECT * FROM users WHERE logidUser=?";
	$stmt = mysqli_stmt_init($conn);

	mysqli_stmt_bind_param($stmt, "s", $logid, $pass);
	mysqli_stmt_execute($stmt);

	$result = mysqli_stmt_get_result($stmt);
	if ($row = mysqli_fetch_assoc()) {
		$pwdCheck = password_verify($pass, $row['pwdUser']);
		if($pwdCheck == false){
			header("Location: ../login.html?error=wrongpwd");
		    exit();

		}
		else if ($pwdCheck == true) {
			header("Location: http://localhost/web/MainPage.html");
			exit();
		}
	}
	else {
		header("Location: ../login.html?error=nouser");
		exit();
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}
?>