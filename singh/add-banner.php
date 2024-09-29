<?php
ob_start();
?>
<?php require('header.php'); ?>


<?php
	$heading1='';
	$heading2='';
	$btn_txt='';
	$btn_link='';
	$order_no=0;
	$image='';
	$msg='';
	$image_required='required';
	
	if(isset($_GET['id']) && $_GET['id']!=''){
		$image_required='';
		$id=get_safe_value($con,$_GET['id']);
		$res=mysqli_query($con,"select * from banner where id='$id'");
		$check=mysqli_num_rows($res);
		if($check>0){
			$row=mysqli_fetch_assoc($res);
			$heading1=$row['heading1'];
			$heading2=$row['heading2'];
			$btn_txt=$row['btn_txt'];
			$btn_link=$row['btn_link'];
			$order_no=$row['order_no'];
			$image=$row['image'];
		}else{
		//	header("Refresh:0");
			header('location:manage-banner.php');
			die();
		}
	}
	if(isset($_POST['submit'])){
	//    prx($_POST);
		$heading1=get_safe_value($con,$_POST['heading1']);
		$heading2=get_safe_value($con,$_POST['heading2']);
		$btn_txt=get_safe_value($con,$_POST['btn_txt']);
		$btn_link=get_safe_value($con,$_POST['btn_link']);
		$order_no=get_safe_value($con,$_POST['order_no']);
		$image=get_safe_value($con,$_POST['image']);
		
		
		$res=mysqli_query($con,"select * from banner where heading1='$heading1'");
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
	
			  if($msg==''){
				  if(isset($_GET['id']) && $_GET['id']!=''){
					  
					  if($_FILES['image']['name']!=''){
						  $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];	
						//  move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
							move_uploaded_file($_FILES['image']['tmp_name'],'media/banner/'.$image);
					  
					  $update_sql="update banner set heading1='$heading1',heading2='$heading2',btn_txt='$btn_txt',btn_link='$btn_link',order_no='$order_no',image='$image' where id='$id'";
					  
					  }else{
						$update_sql="update banner set heading1='$heading1',heading2='$heading2',btn_txt='$btn_txt',btn_link='$btn_link',order_no='$order_no' where id='$id'";
					  
					  }
					  
					  mysqli_query($con,$update_sql);
					  
						 // $update_sql="update categories set categories='$categories' where id='$id'";
						//  mysqli_query($con,$update_sql);
				}else{
				
				  $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];	
			//	  move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
				  move_uploaded_file($_FILES['image']['tmp_name'],'media/banner/'.$image);
		//	echo "insert into banner(heading1,heading2,btn_txt,btn_link,order_no) values('$heading1','$heading2','$btn_txt','$btn_link','$order_no')";	
				  mysqli_query($con,"insert into banner(heading1,heading2,btn_txt,btn_link,order_no,image,status) values('$heading1','$heading2','$btn_txt','$btn_link','$order_no','$image','1')");
			}
	//		header("refresh:0");
		header('location:manage-banner.php');
		die();
		
		// header('location:manage-slider.php'); without redirect
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
            <h1>Add Banner </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><a href="manage-banner.php">Manage Banner </a></li>
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
                <h3 class="card-title">Add Banner </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data">
                <div class="card-body"><?php echo $msg; ?>
					<div class="row">
						<div class="col-4">
						  <div class="form-group">
							<label for="entertitle">Enter Heading1</label>
							<input name="heading1" type="text" class="form-control" value="<?php echo $heading1; ?>" placeholder="Enter Heading1">
						  </div>
						</div>
						
						<div class="col-4">
						  <div class="form-group">
							<label for="enteralt">Enter Heading2</label>
							<input name="heading2" type="text" class="form-control" value="<?php echo $heading2; ?>" placeholder="Enter Heading2">
						  </div>
						</div>
						<div class="col-4">
						  <div class="form-group">
							<label for="entertitle">Enter Order No</label>
							<input name="order_no" type="text" class="form-control" value="<?php echo $order_no; ?>" placeholder="Enter Order No">
						  </div>
						</div>
						
						<div class="col-4">
						  <div class="form-group">
							<label for="enteralt">Enter Button Text</label>
							<input name="btn_txt" type="text" class="form-control" value="<?php echo $btn_txt; ?>" placeholder="Enter Button Text">
						  </div>
						</div>
						<div class="col-4">
						  <div class="form-group">
							<label for="entertitle">Enter Button Link</label>
							<input name="btn_link" type="text" class="form-control" value="<?php echo $btn_link; ?>" placeholder="Enter Button Link">
						  </div>
						</div>
						
						<div class="col-4">
						  <div class="form-group">
							<label for="photo">Banner Photo</label>
							<input name="image" type="file" class="form-control" value="<?php echo $image ?>" <?php echo $image_required ?> >
							<?php
						      if($image!=''){
							    echo "<a target='_blank' href='".'media/banner/'.$image."'>
							    <img width='50px'  src='".'media/banner/'.$image."'></a>";
						      }                         
						   ?> 
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