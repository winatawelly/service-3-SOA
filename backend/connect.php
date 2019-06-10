<?php
$server = "localhost";
$usernam = "root";
$password = "";
$dbname = "service3";
$conn = new mysqli($server, $usernam, $password, $dbname);
if($conn->connect_error){
	die('COnnection failed: '. $conn->connect_error);
}

?>
