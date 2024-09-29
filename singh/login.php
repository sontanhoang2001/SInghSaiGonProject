<?php 
require ('connection.inc.php');
require ('functions.inc.php');


$msg='';

if(isset($_POST['submit'])){
	$username=get_safe_value($con,$_POST['username']);
	$password=get_safe_value($con,$_POST['password']);
	$sql="select * from admin_users where username='$username' and password='$password'";
	$res=mysqli_query($con,$sql);
	$count=mysqli_num_rows($res);
	if($count>0){
		
		$_SESSION['ADMIN_LOGIN']='yes';
		$_SESSION['ADMIN_USERNAME']=$username;
		$_SESSION['ADMIN_PASSWORD']=$password;
		header('location:index.php');
		die();
		
	}else{
		$msg="Please enter correct details";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login</title>
	<!-- meta tags -->
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
	<!-- /meta tags -->
	<!-- custom style sheet -->
	<link href="../assets/login/css/style.css" rel="stylesheet" type="text/css" />
	<!-- /custom style sheet -->
	<!-- fontawesome css -->
	<link href="../assets/login/css/fontawesome-all.css" rel="stylesheet" />
	<!-- /fontawesome css -->
	<!-- google fonts -->
	<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<!-- /google fonts -->
	<style>
	.alert{
		background:#FF5722;
		text-align:center;
		padding:10px;
		color:#fff;
		border-radius:4px;
	}
	</style>
</head>
<body>
    <h1>Admin Login</h1>
	    <div class="w3l-login-form">
		    <h2>Login Here</h2>
			<h2 style="color:white;"><?php echo $msg; ?></h2>
			    <form action="#" method="post">
				
				    <div class="w3l-form-group">
					    <label>Username</label>
						    <div class="group">
						        <i class="fas fa-user"></i>
								<input type="text" name="username" class="form-control" placeholder="Email/Phone" required />
						    </div>
					</div>
					
					<div class="w3l-form-group">
					    <label>Password</label>
						    <div class="group">
							    <i class="fas fa-unlock"></i>
								<input type="password" name="password" class="form-control" placeholder="Password" required />
							</div>
					</div>
					
					<button type="submit" name="submit">Login</button>
				</form>
		</div>
</body>
</html>