<?php
require('secure.php');
require('facility.php');

if(isset($_POST['id'])){

if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']!=''){
	
}else{
	header('location:kumawatlogin.php');
	die();
}
	$id=get_safe_value($con,$_POST['id']);
	mysqli_query($con,"delete from product_attributes where id='$id'");
}
?>

