<?php
ob_start();
?>
<?php require('header.php'); ?>



<?php
	$categories='';
	$categories_id='';
	$sub_categories='';
	$msg='';
	
	
	if(isset($_GET['id']) && $_GET['id']!=''){
		
		$id=get_safe_value($con,$_GET['id']);
		$res=mysqli_query($con,"select * from sub_categories where id='$id'");
		$check=mysqli_num_rows($res);
		if($check>0){
			$row=mysqli_fetch_assoc($res);
			$categories=$row['categories_id'];
			$sub_categories=$row['sub_categories'];
		}else{
		//	header("Refresh:0");
			header('location:manage-sub-category.php');
			die();
		}
	}
	if(isset($_POST['submit'])){
		$categories=get_safe_value($con,$_POST['categories_id']);
		$sub_categories=get_safe_value($con,$_POST['sub_categories']);
		
		
		$res=mysqli_query($con,"select * from sub_categories where categories_id='$categories' and sub_categories='$sub_categories'");
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
		
	
			  if($msg==''){
				  if(isset($_GET['id']) && $_GET['id']!=''){
					  mysqli_query($con,"update sub_categories set categories_id='$categories',sub_categories='$sub_categories' where id='$id'");
					  
						 // $update_sql="update categories set categories='$categories' where id='$id'";
						//  mysqli_query($con,$update_sql);
				}else{
				
				  
				  mysqli_query($con,"insert into sub_categories(categories_id,sub_categories,status) values('$categories','$sub_categories','1')");
			}
	//		header("refresh:0");
		header('location:manage-sub-category.php');
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
            <h1>Add Sub Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><a href="manage-sub-category.php">Manage Sub Category</a></li>
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
                <h3 class="card-title">Add Sub Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data">
                <div class="card-body"><?php echo $msg; ?>
					<div class="row">
						<div class="col-4">
						  <div class="form-group">
							<label for="enterproductname">Select Category Name</label>
							<select class="form-control" name="categories_id" required>
								<option value="">Select Category</option>
								<?php
								$res=mysqli_query($con,"select * from categories where status='1'");
								while($row=mysqli_fetch_assoc($res)){
									if($row['id']==$categories){
									echo "<option value=".$row['id']." selected>".$row['categories']."</option>";
									}else{
									echo "<option value=".$row['id'].">".$row['categories']."</option>";	
									}
								}
								?>
							</select>
						  </div>
						</div>
						<div class="col-4">
						  <div class="form-group">
							<label for="enterproductname">Enter Sub Category Name</label>
							<input name="sub_categories" type="text" class="form-control" value="<?php echo $sub_categories; ?>" placeholder="Enter Sub Category Name">
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