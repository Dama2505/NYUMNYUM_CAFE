<?php
// order.php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
	
	//Database Connection
	
	$host = "localhost";
	$dbusername = "root";
	$dbpassword = "";
	$dbname = "auth";
	
	$conn = new mysqli($host,$dbusername,$dbpassword,$dbname);
	
 if($conn->connect_error){
	 die("connection failed:". $conn->connect_error);
 }
	
	//validate login authentication
	$query = "SELECT * FROM login WHERE username='$username'AND password='$password'";
	
	$result = $conn->query($query);
	
	if($result->num_rows == 1){
		//Login success
		header('Location: ADMIN.php');
		exit();
	}
	else{
		//login failed
		header("Location: error.html");
		exit();
		
	}
	$conn->closer();
	}

?>