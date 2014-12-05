<?php
session_start();
if(!$_SESSION['userId']){
	header("Location: login.php");
}
$con=mysqli_connect("localhost","root","intuit01","painting_portal"); 
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}
$userId = $_SESSION['userId'];
$checkoutList = array();
	$query = " select * from checkout where user_id=$userId";
	$results = mysqli_query($con,$query);
 	$num_rows = mysqli_num_rows($results);
if($num_rows>0){
	while($data = mysqli_fetch_array($results,MYSQL_ASSOC)){
		$checkoutList[]=$data;
	}

}
	echo json_encode($checkoutList);

?>