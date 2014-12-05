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


	// $query = " select * from checkout where user_id in (select cart_id from checkout where user_id=$userId) order_by ";
	// $cart = mysqli_query($con,$query);
 // 	$num_carts = mysqli_num_rows($cart);
	// if($num_carts==1){
	// 	$row = mysqli_fetch_assoc($cart);
	// 	$cartId = intval($row['cart_id']);
	// 	$upadteQuery = "update  cart set is_processed=true where cart_id=$cartId";
	// 	$retval = mysqli_query($con,$upadteQuery);
	// 	if($retval){
	// 		$checkoutQuery = "insert into checkout values($userId,$cartId,$cartTotal,now(),'$address',$phoneNumber)";
	// 		$checkout = mysqli_query($con,$checkoutQuery);
	// 		$insertquery = "insert into cart(user_id,is_processed) values ($userId,false)";
	// 		$retval = mysqli_query($con,$insertquery);
	// 		header("Location: home.php");

	// 	}
	// }

?>