<?php

$servername ="localhost";
$dbUsername ="nysa";
$dbPassword ="Chicky123";
$dbName ="nysa";

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);


if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}

?>