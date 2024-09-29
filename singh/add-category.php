<?php
ob_start();
?>
<?php require('header.php'); ?>


<?php
	$categories='';
	$created_at='';
	$msg='';
	
	
	if(isset($_GET['id']) && $_GET['id']!=''){
		
		$id=get_safe_value($con,$_GET['id']);
		$res=mysqli_query($con,"select * from categories where id='$id'");
		$check=mysqli_num_rows($res);
		if($check>0){
			$row=mysqli_fetch_assoc($res);
			$categories=$row['categories'];
			$created_at=$row['created_at'];
		}else{
		//	header("Refresh:0");
			header('location:manage-category.php');
			die();
		}
	}
	if(isset($_POST['submit'])){
		$categories=get_safe_value($con,$_POST['categories']);
	//	$created_at=get_safe_value($con,$_POST['created_at']);
	//	$created_at=date('Y-m-d h:i:s');
		$created_at=date('Y-m-d');
		
		$res=mysqli_query($con,"select * from categories where categories='$categories'");
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
					  mysqli_query($con,"update categories set categories='$categories',created_at='$created_at' where id='$id'");
					  
						 // $update_sql="update categories set categories='$categories' where id='$id'";
						//  mysqli_query($con,$update_sql);
				}else{
				
				  
				  mysqli_query($con,"insert into categories(categories,created_at,status) values('$categories','$created_at','1')");
			}
	//		header("refresh:0");
		header('location:manage-category.php');
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
            <h1>Add Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><a href="manage-category.php">Manage Category</a></li>
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
                <h3 class="card-title">Add Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data">
                <div class="card-body"><?php echo $msg; ?>
					<div class="row">
						<div class="col-4">
						  <div class="form-group">
							<label for="enterproductname">Enter Category Name</label>
							<input name="categories" type="text" class="form-control" value="<?php echo $categories; ?>" placeholder="Enter Category Name">
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