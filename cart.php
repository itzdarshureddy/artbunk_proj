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

if($_GET['cart_id']){
	$getCartId = $_GET['cart_id'];
	$query = "select painting_id,painting_name,category_id,artist_name,seller_id,price,dimensions,painting_status,painting_year,description,date_uploaded from painting where painting_id in (select painting_id from cart_list where cart_list.cart_id=$getCartId)";

	$results = mysqli_query($con,$query);
$rows= array();
$num_rows = mysqli_num_rows($results);
if($num_rows>0){
	while($data = mysqli_fetch_array($results,MYSQL_ASSOC)){
		$rows[]=$data;
	}

}
	echo json_encode($rows);

}

elseif($_GET['method']=='add' && $_GET['painting_id']){
	$paintingId = intval($_GET['painting_id']);
	$query = "select cart_id from cart where user_id=$userId and is_processed=false";
	$cart = mysqli_query($con,$query);
	$num_carts = mysqli_num_rows($cart);
	if($num_carts==1){
		$row = mysqli_fetch_assoc($cart);
		$cartId = intval($row['cart_id']);
		$upadteQuery = "insert into cart_list(cart_id,painting_id,add_date) values($cartId,$paintingId,now())";
		$retval = mysqli_query($con,$upadteQuery);
		if($retval){
			echo "success";
		}
	}
	else{
		$insertquery = "insert into cart(user_id,is_processed) values ($userId,false)";
		$retval = mysqli_query($con,$insertquery);
		$query = "select cart_id from cart where user_id=$userId and is_processed=false";
		$newCart = mysqli_query($con,$query);
		$num_new_carts = mysqli_num_rows($newCart);
		if($num_new_carts==1){
		$row = mysqli_fetch_assoc($newCart);
		$cartId = intval($row['cart_id']);
		$upadteQuery = "insert into cart_list(cart_id,painting_id,add_date) values($cartId,$paintingId,now())";
		$retval = mysqli_query($con,$upadteQuery);
		if($retval){
			echo "success";
		}
	}
	}
	
}elseif ($_GET['method']=='remove' && $_GET['painting_id']) {
	$paintingId = intval($_GET['painting_id']);
	$query = "select cart_id from cart where user_id=$userId and is_processed=false";
	$cart = mysqli_query($con,$query);
	$num_carts = mysqli_num_rows($cart);
	if($num_carts==1){
		$row = mysqli_fetch_assoc($cart);
		$cartId = intval($row['cart_id']);
		$upadteQuery = "delete from cart_list where cart_id=$cartId and painting_id=$paintingId";
		$retval = mysqli_query($con,$upadteQuery);
		if($retval){
			echo "success";
		}
	}
}


else{
	$query = "select painting_id,painting_name,category_id,artist_name,seller_id,price,dimensions,painting_status,painting_year,description,date_uploaded from painting where painting_id in (select painting_id from cart_list,cart where cart_list.cart_id=cart.cart_id and cart.user_id=$userId and cart.is_processed=false)";

	$results = mysqli_query($con,$query);
$rows= array();
$num_rows = mysqli_num_rows($results);
if($num_rows>0){
	while($data = mysqli_fetch_array($results,MYSQL_ASSOC)){
		$rows[]=$data;
	}

}
	echo json_encode($rows);

}

?>