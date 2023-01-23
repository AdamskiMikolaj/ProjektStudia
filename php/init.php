<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sklepprojekt";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}
$conn->set_charset('utf8mb4');
?>