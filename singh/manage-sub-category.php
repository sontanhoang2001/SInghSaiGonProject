<?php include('header.php'); ?>


<?php
	// Status List
	if(isset($_GET['type']) && $_GET['type']!=''){
		$type=get_safe_value($con,$_GET['type']);
    if($type=='status'){
		$operation=get_safe_value($con,$_GET['operation']);
		$id=get_safe_value($con,$_GET['id']);
    if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
    $update_status_sql="update sub_categories set status='$status' where id='$id'";
	mysqli_query($con,$update_status_sql);
	}
} //Last m add kiye h isko
	// Status List
	// Delete List
	if(isset($_GET['type']) && $_GET['type']!=''){ //Last m add kiye h isko
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from sub_categories where id='$id'";
		mysqli_query($con,$delete_sql);
	}
}
	// Delete List
	// Display List
	$sql="select sub_categories.*,categories.categories from sub_categories,categories where categories.id=sub_categories.categories_id order by sub_categories.sub_categories asc";
	$res=mysqli_query($con,$sql);
	// Display List
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Categories</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><a href="add-sub-category.php">Add Categories</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Categories List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S No.</th>  
                    <th>Id</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                 <?php 
					$i=1;
					while($row=mysqli_fetch_assoc($res)){ 
				 ?>
                  <tr>
                    <td><?php echo $i; ?></td> 
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['categories']; ?></td>
                    <td><?php echo $row['sub_categories']; ?></td>
                    <td>
						<?php
							echo "<button type='button' class='btn btn-block btn-info'><a href='add-sub-category.php?id=".$row['id']."' style='color:#ececec;'>Edit</a></button>";
							echo "<button type='button' class='btn btn-block btn-danger'><a href='?type=delete&id=".$row['id']."' style='color:#ececec;'>Delete</a></button>";
						?>	
						<?php
							if($row['status']==1){
								echo "<button type='button' class='btn btn-block btn-primary'><a href='?type=status&operation=deactive&id=".$row['id']."' style='color:#ececec;'>Active</a></button>";
							}else{
								echo "<button type='button' class='btn btn-block btn-success'><a href='?type=status&operation=active&id=".$row['id']."' style='color:#ececec;'>Deactive</a></button>";
							}
						?>
					</td>
                  </tr>
				 <?php } ?>
                  
                  
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<?php include('footer.php'); ?>