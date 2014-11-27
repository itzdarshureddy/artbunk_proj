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
$query = "";
if($_GET["searchName"]){
	$searchString = $_GET["searchName"];
	$query = "select painting_id,painting_name,category_id,artist_name,seller_id,price,dimensions,painting_status,painting_year,description from painting where painting_name LIKE '%$searchString%'";
}elseif ($_GET['category']) {
	$category = $_GET['category'];
	$query = "select painting_id,painting_name,category_id,artist_name,seller_id,price,dimensions,painting_status,painting_year,description from painting where category_id=$category";
} 
else{
$query = "select painting_id,painting_name,category_id,artist_name,seller_id,price,dimensions,painting_status,painting_year,description from painting";
}
$results = mysqli_query($con,$query);
$num_rows = mysqli_num_rows($results);
if($num_rows>0){
	$rows= array();
	while($data = mysqli_fetch_array($results,MYSQL_ASSOC)){
		$rows[]=$data;
	}

	echo json_encode($rows);
}

?>