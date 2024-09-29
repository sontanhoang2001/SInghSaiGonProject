<?php
ob_start();
?>
<?php require('header.php'); ?>


<?php
	$name='';
	$email='';
	$username='';
	$password='';
	$mobile='';
	$address='';
	$msg='';
	$image='';
	
	$image_required='required';
	
	if(isset($_GET['id']) && $_GET['id']!=''){
		
		$image_required='';
		
		$id=get_safe_value($con,$_GET['id']);
		$res=mysqli_query($con,"select * from admin_users where id='$id'");
		$check=mysqli_num_rows($res);
		if($check>0){
			$row=mysqli_fetch_assoc($res);
			$name=$row['name'];
			$email=$row['email'];
			$username=$row['username'];
			$password=$row['password'];
			$mobile=$row['mobile'];
			$address=$row['address'];
			$image=$row['image'];
		}else{
		//	header("Refresh:0");
			header('location:manage-profile.php');
			die();
		}
	}
	if(isset($_POST['submit'])){
		$name=get_safe_value($con,$_POST['name']);
		$email=get_safe_value($con,$_POST['email']);
		$username=get_safe_value($con,$_POST['username']);
		$password=get_safe_value($con,$_POST['password']);
		$mobile=get_safe_value($con,$_POST['mobile']);
		$address=get_safe_value($con,$_POST['address']);
		//$image=get_safe_value($con,$_POST['image']);
		
		
		$res=mysqli_query($con,"select * from admin_users where mobile='$mobile'");
		$check=mysqli_num_rows($res);
		if($check>0){
			if(isset($_GET['id']) && $_GET['id']!=''){
				$getData=mysqli_fetch_assoc($res);
				if($id==$getData['id']){
					
				}else{
					$msg="Data Allready Exist! Pls Try Again Other Data";
				}
			}else{
			$msg="Data Allready Exist! Pls Try Again Other Data";
			  }
		}
		
	//	prx($_FILES);
		if($_FILES['image']['type']!=''){
				if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
				$msg="Please select only png,jpg and jpeg image formate";
			}
		}
		
	//	if($_FILES['image']['size']='2000000'){
			//	if($_FILES['image']['size']='2000000'){
			//	$msg="Please select only 1000kb image size"; 
		//	}
	//	} 
	//	$size=$_FILES['image']['size']/1024;
	//	if($size<20){
	//		$_FILES['image']['size']='20';
 
	//	}else{
	//	echo "only 200";
	//	}
		
			  if($msg==''){
				  if(isset($_GET['id']) && $_GET['id']!=''){
					  
					  if($_FILES['image']['name']!=''){
						  $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];	
					//	  move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
					      move_uploaded_file($_FILES['image']['tmp_name'],'media/profile/'.$image);
						  
						  $update_sql="update admin_users set name='$name',email='$email',username='$username',password='$password',mobile='$mobile',address='$address',image='$image' where id='$id'";
					  }else{
						  $update_sql="update admin_users set name='$name',email='$email',username='$username',password='$password',mobile='$mobile',address='$address' where id='$id'";
					  }
					  
				  mysqli_query($con,$update_sql);
				}else{
				
				  $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];	
			//	  move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
			      move_uploaded_file($_FILES['image']['tmp_name'],'media/profile/'.$image);
				  
				  mysqli_query($con,"insert into admin_users(name,email,username,password,mobile,address,image,status) values('$name','$email','$username','$password','$mobile','$address','$image','1')");
			}
	//		header("refresh:0");
		header('location:manage-profile.php');
		die();
		
		// header('location:manage-profile.php'); without redirect
		// die(); 
		
			  }
	}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><a href="manage-profile.php">Manage Profile</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
	<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Profile</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data">
                <div class="card-body"><?php echo $msg; ?>
					<div class="row">
						<div class="col-4">
						  <div class="form-group">
							<label for="entername">Enter Name</label>
							<input name="name" type="text" class="form-control" value="<?php echo $name; ?>" placeholder="Enter Name">
						  </div>
						</div>
						<div class="col-4">
						  <div class="form-group">
							<label for="enteremail">Enter Email</label>
							<input name="email" type="email" class="form-control" value="<?php echo $email; ?>" placeholder="Enter Email">
						  </div>
						</div>
						<div class="col-4">
						  <div class="form-group">
							<label for="enterusername">Enter Username</label>
							<input name="username" type="email" class="form-control" value="<?php echo $username; ?>" placeholder="Enter Username">
						  </div>
						</div>
						<div class="col-4">
						  <div class="form-group">
							<label for="enterpassword">Enter Password</label>
							<input name="password" type="password" class="form-control" value="<?php echo $password; ?>" placeholder="Enter Password">
						  </div>
						</div>
						<div class="col-4">
						  <div class="form-group">
							<label for="entermobile">Enter Mobile</label>
							<input name="mobile" type="number" class="form-control" value="<?php echo $mobile; ?>" placeholder="Enter Mobile">
						  </div>
						</div>
						<div class="col-4">
						  <div class="form-group">
							<label for="photo">Photo</label>
							<input name="image" type="file" class="form-control" value="<?php echo $image ?>" <?php echo $image_required ?> >
							<?php
						      if($image!=''){
							    echo "<a target='_blank' href='".'media/profile/'.$image."'>
							    <img width='50px'  src='".'media/profile/'.$image."'></a>";
						      }                         
						   ?>
						  </div>
						</div>
						<div class="col-12">
						  <div class="form-group">
							<label for="enteraddress">Enter Address</label>
							<textarea name="address" type="text" class="form-control" placeholder="Enter Address"><?php echo $address; ?></textarea>
						  </div>
						</div>                 
					</div>  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->            
          </div>        
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>		
  </div>
<?php require('footer.php'); ?>
<?php
ob_end_flush();
?>