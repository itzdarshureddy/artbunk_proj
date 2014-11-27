<?php
session_start();
if($_SESSION['userId']){
	session_unset();
	session_destroy();
	session_start();
}
$con=mysqli_connect("localhost","root","intuit01","painting_portal"); 
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}
$email =  $_GET['email'];
$query = "select * from user where email=$email";
$results = mysqli_query($con,$query);
$num_rows = mysqli_num_rows($results);
if($num_rows>0){
	echo "True";
}else{
	echo "False";
}

?>