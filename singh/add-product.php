<?php
ob_start();
?>
<?php require('header.php'); 

$categories_id='';
$name='';
$beverage_drinks='';
$dairy_products='';
$fashion_beauty='';
$fruits_vegitables='';
$health_care_products='';
$home_essentials='';
$indian_grocery='';
$pet_products='';
$tiffin_service='';
$discount='';
$mrp='';
$price='';
$qty='';
$gklp='';
$image='';
$short_desc	='';
$description	='';
$meta_title	='';
$meta_desc	='';
$meta_keyword='';
$sub_categories_id='';

$msg='';
$image_required='required';

	//Multiple Product
	$multipleImageArr=[];
	
	$attrProduct[0]['product_id']='';
	$attrProduct[0]['size_id']='';
	$attrProduct[0]['color_id']='';
	$attrProduct[0]['mrp']='';
	$attrProduct[0]['price']='';
	$attrProduct[0]['qty']='';
	$attrProduct[0]['id']='';
	
	
	if(isset($_GET['pi']) && $_GET['pi']>0){
		$pi=get_safe_value($con,$_GET['pi']);
		$delete_sql="delete from product_images where id='$pi'";
		mysqli_query($con,$delete_sql);
	}
	
	
	//Multiple Product
	
	
	
if(isset($_GET['id']) && $_GET['id']!=''){
	$image_required='';
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from product where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$categories_id=$row['categories_id'];
		$sub_categories_id=$row['sub_categories_id'];
		$name=$row['name'];
		$beverage_drinks=$row['beverage_drinks'];
        $dairy_products=$row['dairy_products'];
        $fashion_beauty=$row['fashion_beauty'];
        $fruits_vegitables=$row['fruits_vegitables'];
        $health_care_products=$row['health_care_products'];
        $home_essentials=$row['home_essentials'];
        $indian_grocery=$row['indian_grocery'];
        $pet_products=$row['pet_products'];
        $tiffin_service=$row['tiffin_service'];
        $discount=$row['discount'];
		$mrp=$row['mrp'];
		$price=$row['price'];
		$qty=$row['qty'];
		$gklp=$row['gklp'];
		$short_desc=$row['short_desc'];
		$description=$row['description'];
		$meta_title=$row['meta_title'];
		$meta_desc=$row['meta_desc'];
		$meta_keyword=$row['meta_keyword'];
		$image=$row['image'];
		
		// Multiple Product
			$resMultipleImage=mysqli_query($con,"select id,product_images from product_images where product_id='$id'");
			if(mysqli_num_rows($resMultipleImage)>0){
				$jj=0;
				while($rowMultipleImage=mysqli_fetch_assoc($resMultipleImage)){
					$multipleImageArr[$jj]['product_images']=$rowMultipleImage['product_images'];
					$multipleImageArr[$jj]['id']=$rowMultipleImage['id'];
					$jj++;
				}
			}
			// Multiple Product	
			
	}else{
		header('location:manage-product.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$categories_id=get_safe_value($con,$_POST['categories_id']);
	$sub_categories_id=get_safe_value($con,$_POST['sub_categories_id']);
	$name=get_safe_value($con,$_POST['name']);
	$beverage_drinks=get_safe_value($con,$_POST['beverage_drinks']);
    $dairy_products=get_safe_value($con,$_POST['dairy_products']);
    $fashion_beauty=get_safe_value($con,$_POST['fashion_beauty']);
    $fruits_vegitables=get_safe_value($con,$_POST['fruits_vegitables']);
    $health_care_products=get_safe_value($con,$_POST['health_care_products']);
    $home_essentials=get_safe_value($con,$_POST['home_essentials']);
    $indian_grocery=get_safe_value($con,$_POST['indian_grocery']);
    $pet_products=get_safe_value($con,$_POST['pet_products']);
    $tiffin_service=get_safe_value($con,$_POST['tiffin_service']);
    $discount=get_safe_value($con,$_POST['discount']);
	$mrp=get_safe_value($con,$_POST['mrp']);
	$price=get_safe_value($con,$_POST['price']);
	$qty=get_safe_value($con,$_POST['qty']);
	$gklp=get_safe_value($con,$_POST['gklp']);
	$short_desc=get_safe_value($con,$_POST['short_desc']);
	$description=get_safe_value($con,$_POST['description']);
	$meta_title=get_safe_value($con,$_POST['meta_title']);
	$meta_desc=get_safe_value($con,$_POST['meta_desc']);
	$meta_keyword=get_safe_value($con,$_POST['meta_keyword']);
	
	$res=mysqli_query($con,"select * from product where name='$name'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="Product already exist";
			}
		}else{
			$msg="Product already exist";
		}
	}
	
	if(isset($_GET['id']) && $_GET['id']==0){
		if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
			$msg="Please select only png,jpg and jpeg image formate";
		}
	}else{
		if($_FILES['image']['type']!=''){
				if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
				$msg="Please select only png,jpg and jpeg image formate";
			}
		}
	}
	
	
	// Multiple Product
		if(isset($_FILES['product_images'])){
		//	echo "hello";
			foreach($_FILES['product_images']['type'] as $key=>$val){
			//	pr($key);
			//	prx($val);
				if($_FILES['product_images']['type'][$key]!=''){
				if($_FILES['product_images']['type'][$key]!='image/png' && $_FILES['product_images']['type'][$key]!='image/jpg' && $_FILES['product_images']['type'][$key]!='image/jpeg'){
					$msg="Pls Select multiple image";
				}
				}
			}
		}
		// Multiple Product
		
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			if($_FILES['image']['name']!=''){ 
				$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
				 move_uploaded_file($_FILES['image']['tmp_name'],'media/product/'.$image);
				$update_sql="update product set categories_id='$categories_id',name='$name',beverage_drinks='$beverage_drinks',dairy_products='$dairy_products',fashion_beauty='$fashion_beauty',fruits_vegitables='$fruits_vegitables',health_care_products='$health_care_products',home_essentials='$home_essentials',indian_grocery='$indian_grocery',pet_products='$pet_products',tiffin_service='$tiffin_service',discount='$discount',mrp='$mrp',price='$price',qty='$qty',gklp='$gklp',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',image='$image',sub_categories_id='$sub_categories_id' where id='$id'";
			}else{
				$update_sql="update product set categories_id='$categories_id',name='$name',beverage_drinks='$beverage_drinks',dairy_products='$dairy_products',fashion_beauty='$fashion_beauty',fruits_vegitables='$fruits_vegitables',health_care_products='$health_care_products',home_essentials='$home_essentials',indian_grocery='$indian_grocery',pet_products='$pet_products',tiffin_service='$tiffin_service',discount='$discount',mrp='$mrp',price='$price',qty='$qty',gklp='$gklp',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',sub_categories_id='$sub_categories_id' where id='$id'";
			}
			mysqli_query($con,$update_sql);
		}else{
			$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
			 move_uploaded_file($_FILES['image']['tmp_name'],'media/product/'.$image);
			mysqli_query($con,"insert into product(categories_id,name,beverage_drinks,dairy_products,fashion_beauty,fruits_vegitables,health_care_products,home_essentials,indian_grocery,pet_products,tiffin_service,discount,mrp,price,qty,gklp,short_desc,description,meta_title,meta_desc,meta_keyword,status,image,sub_categories_id) values('$categories_id','$name','$beverage_drinks','$dairy_products','$fashion_beauty','$fruits_vegitables','$health_care_products','$home_essentials','$indian_grocery','$pet_products','$tiffin_service','$discount','$mrp','$price','$qty','$gklp','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword',1,'$image','$sub_categories_id')");
			$id=mysqli_insert_id($con);
		}
		
		
		
		/* Product Multiple Image Upload Start */
				if(isset($_GET['id']) && $_GET['id']!=''){
				    if(isset($_FILES['product_images']['name'])){
					foreach($_FILES['product_images']['name'] as $key=>$val){
						if($_FILES['product_images']['name'][$key]!=''){
							if(isset($_POST['product_images_id'][$key])){
								$image=rand(111111111,999999999).'_'.$_FILES['product_images']['name'][$key];
						
								move_uploaded_file($_FILES['product_images']['tmp_name'][$key],'media/product/'.$image);
					
								mysqli_query($con, "update product_images set product_images='$image' where id='".$_POST['product_images_id'][$key]."'");
							}else{
								$image=rand(111111111,999999999).'_'.$_FILES['product_images']['name'][$key];
						
								move_uploaded_file($_FILES['product_images']['tmp_name'][$key],'media/product/'.$image);
					
								mysqli_query($con, "insert into product_images(product_id,product_images) values('$id','$image')");
							}
						}
					}
				    }
				}else{
					if(isset($_FILES['product_images']['name'])){
					  foreach($_FILES['product_images']['name'] as $key=>$val){
					  // $_FILES['product_images']['type'][$key]
						
						$image=rand(111111111,999999999).'_'.$_FILES['product_images']['name'][$key];
						
						move_uploaded_file($_FILES['product_images']['tmp_name'][$key],'media/product/'.$image);
						
					//	echo "insert into product_images(product_id,product_images) values('$id','$image')";
						
						mysqli_query($con, "insert into product_images(product_id,product_images) values('$id','$image')");
					}
				} 
			}
			/* Product Multiple Image Upload End */
		
		header('location:manage-product.php');
		die();
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
            <h1>Add Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><a href="manage-product.php">Manage Product</a></li>
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
                <h3 class="card-title">Add Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data">
                <div class="card-body"><?php echo $msg; ?>
					<div class="row">
					    <div class="col-4">
						  <div class="form-group">
							<label for="enterproductname">Select Category Name</label>
							<select class="form-control" name="categories_id" id="categories_id" onChange="get_sub_cat('')" required>
								<option>Select Category</option>
								<?php
								$res=mysqli_query($con,"select id,categories from categories order by categories asc");
									while($row=mysqli_fetch_assoc($res)){
									if($row['id']==$categories_id){
										echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
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
							<label for="enterproductname">Select Sub Category Name</label>
							<select class="form-control" name="sub_categories_id" id="sub_categories_id">
								<option value="">Select Sub Category</option>
								
							</select>
						  </div>
						</div>
					    
					    <div class="col-4">
						  <div class="form-group">
							<label for="enterproductname">Beverage & Drinks</label>
							<select class="form-control" name="beverage_drinks">
								<option value="">Select Beverage & Drinks</option>
								<?php
								if($beverage_drinks==1){
									echo '<option value="1" selected>Yes</option>
									<option value="0">No</option>';
								}elseif($beverage_drinks==0){
									echo '<option value="1">Yes</option>
									<option value="0" selected>No</option>';
								}else{
									echo '<option value="1">Yes</option>
									<option value="0">No</option>';
								}
								?>
							</select>
						  </div>
						</div>
						
						<div class="col-4">
						  <div class="form-group">
							<label for="enterproductname">Dairy Products</label>
							<select class="form-control" name="dairy_products">
								<option value="">Select Dairy Products</option>
								<?php
								if($dairy_products==1){
									echo '<option value="1" selected>Yes</option>
									<option value="0">No</option>';
								}elseif($dairy_products==0){
									echo '<option value="1">Yes</option>
									<option value="0" selected>No</option>';
								}else{
									echo '<option value="1">Yes</option>
									<option value="0">No</option>';
								}
								?>
							</select>
						  </div>
						</div>
						
						<div class="col-4">
						  <div class="form-group">
							<label for="enterproductname">Fashion & Beauty</label>
							<select class="form-control" name="fashion_beauty">
								<option value="">Select Fashion & Beauty</option>
								<?php
								if($fashion_beauty==1){
									echo '<option value="1" selected>Yes</option>
									<option value="0">No</option>';
								}elseif($fashion_beauty==0){
									echo '<option value="1">Yes</option>
									<option value="0" selected>No</option>';
								}else{
									echo '<option value="1">Yes</option>
									<option value="0">No</option>';
								}
								?>
							</select>
						  </div>
						</div>
						
						<div class="col-4">
						  <div class="form-group">
							<label for="enterproductname">Fruits & Vegitables</label>
							<select class="form-control" name="fruits_vegitables">
								<option value="">Select Fruits & Vegitables</option>
								<?php
								if($fruits_vegitables==1){
									echo '<option value="1" selected>Yes</option>
									<option value="0">No</option>';
								}elseif($fruits_vegitables==0){
									echo '<option value="1">Yes</option>
									<option value="0" selected>No</option>';
								}else{
									echo '<option value="1">Yes</option>
									<option value="0">No</option>';
								}
								?>
							</select>
						  </div>
						</div>
						
						<div class="col-4">
						  <div class="form-group">
							<label for="enterproductname">Health Care Products</label>
							<select class="form-control" name="health_care_products">
								<option value="">Select Health Care Products</option>
								<?php
								if($health_care_products==1){
									echo '<option value="1" selected>Yes</option>
									<option value="0">No</option>';
								}elseif($health_care_products==0){
									echo '<option value="1">Yes</option>
									<option value="0" selected>No</option>';
								}else{
									echo '<option value="1">Yes</option>
									<option value="0">No</option>';
								}
								?>
							</select>
						  </div>
						</div>
						
						<div class="col-4">
						  <div class="form-group">
							<label for="enterproductname">Home Essentials</label>
							<select class="form-control" name="home_essentials">
								<option value="">Select Home Essentials</option>
								<?php
								if($home_essentials==1){
									echo '<option value="1" selected>Yes</option>
									<option value="0">No</option>';
								}elseif($home_essentials==0){
									echo '<option value="1">Yes</option>
									<option value="0" selected>No</option>';
								}else{
									echo '<option value="1">Yes</option>
									<option value="0">No</option>';
								}
								?>
							</select>
						  </div>
						</div>
						
						<div class="col-4">
						  <div class="form-group">
							<label for="enterproductname">Indian Grocery</label>
							<select class="form-control" name="indian_grocery">
								<option value="">Select Indian Grocery</option>
								<?php
								if($indian_grocery==1){
									echo '<option value="1" selected>Yes</option>
									<option value="0">No</option>';
								}elseif($indian_grocery==0){
									echo '<option value="1">Yes</option>
									<option value="0" selected>No</option>';
								}else{
									echo '<option value="1">Yes</option>
									<option value="0">No</option>';
								}
								?>
							</select>
						  </div>
						</div>
						
						<div class="col-4">
						  <div class="form-group">
							<label for="enterproductname">Pet Products</label>
							<select class="form-control" name="pet_products">
								<option value="">Select Pet Products</option>
								<?php
								if($pet_products==1){
									echo '<option value="1" selected>Yes</option>
									<option value="0">No</option>';
								}elseif($pet_products==0){
									echo '<option value="1">Yes</option>
									<option value="0" selected>No</option>';
								}else{
									echo '<option value="1">Yes</option>
									<option value="0">No</option>';
								}
								?>
							</select>
						  </div>
						</div>
						
						<div class="col-4">
						  <div class="form-group">
							<label for="enterproductname">Tiffin Service</label>
							<select class="form-control" name="tiffin_service">
								<option value="">Select Tiffin Service</option>
								<?php
								if($tiffin_service==1){
									echo '<option value="1" selected>Yes</option>
									<option value="0">No</option>';
								}elseif($tiffin_service==0){
									echo '<option value="1">Yes</option>
									<option value="0" selected>No</option>';
								}else{
									echo '<option value="1">Yes</option>
									<option value="0">No</option>';
								}
								?>
							</select>
						  </div>
						</div>
						
						<div class="col-4">
						  <div class="form-group">
							<label for="enterproductname">Enter Product Name</label>
							<input name="name" type="text" class="form-control" value="<?php echo $name; ?>" placeholder="Enter Product Name">
						  </div>
						</div>
						
						<div class="col-4">
						  <div class="form-group">
							<label for="enterproductname">Enter Product MRP</label>
							<input name="mrp" type="text" class="form-control" value="<?php echo $mrp; ?>" placeholder="Enter Product MRP">
						  </div>
						</div>
						<div class="col-4">
						  <div class="form-group">
							<label for="enterproductname">Enter Product Price</label>
							<input name="price" type="text" class="form-control" value="<?php echo $price; ?>" placeholder="Enter Product Price">
						  </div>
						</div>
						
						<div class="col-4">
						  <div class="form-group">
							<label for="enterproductname">Enter Discount</label>
							<input name="discount" type="text" class="form-control" value="<?php echo $discount; ?>" placeholder="Enter Discount">
						  </div>
						</div>
						<div class="col-4">
						  <div class="form-group">
							<label for="enterproductname">Enter Product QTY</label>
							<input name="qty" type="text" class="form-control" value="<?php echo $qty; ?>" placeholder="Enter Product QTY">
						  </div>
						</div>
						<div class="col-4">
						  <div class="form-group">
							<label for="enterproductname">Enter Product Gram/KG/Litre/Piece</label>
							<input name="gklp" type="text" class="form-control" value="<?php echo $gklp; ?>" placeholder="Enter Product Gram/KG/Litre/Piece">
						  </div>
						</div>
						
						
						<div class="col-md-8">
						<div class="row" id="image_box">
						    
						<div class="col-8">
						  <div class="form-group">
							<label for="enterproductname">Enter Product Photo</label>
							<input type="file" name="image" id="image" class="form-control" <?php echo  $image_required?> >
						  </div>
						  <?php
								if($image!=''){
									echo "<a target='_blank' href='".'media/product/'.$image."'><img src='".'media/product/'.$image."' style='height:50px;'></a>";
								}
							?>
						</div>
						
						<div class="col-4">
						  <div class="form-group">
							<label for="enterproductname"></label><br>
							<button type="submit" onClick="add_more_images()" class="btn btn-primary">Add More Photo</button>
						  </div>
						</div>
						<?php
							if(isset($multipleImageArr[0])){
								foreach($multipleImageArr as $list){
									echo '<div class="col-8" id="add_image_box_'.$list['id'].'"><div class="form-group"><label for="productphoto">Product Photo</label><input name="product_images[]" type="file" class="form-control" ></div><div class="col-4"><a href="add-product.php?id='.$id.'&pi='.$list['id'].'" style="color:white;"><button type="button" class="btn btn-danger" >Remove</button></a>';
									echo "<a target='_blank' href='".'media/product/'.$list['product_images']."'><img src='".'media/product/'.$list['product_images']."' style='height:50px;margin-left:4px;'></a>";
									echo'<input type="hidden" name="product_images_id[]" value="'.$list['id'].'"></div></div>';
								}
							}
						?>
						</div>
						</div>
						
						
						<div class="col-4">
						  <div class="form-group">
							<label for="enterproductname">Enter Product Short Description</label>
							<textarea name="short_desc" type="text" class="form-control" placeholder="Enter Product Name"><?php echo $short_desc; ?></textarea>
						  </div>
						</div>
						<div class="col-6">
						  <div class="form-group">
							<label for="enterproductname">Enter Product Description</label>
							<textarea name="description" type="text" class="form-control" placeholder="Enter Product Name"><?php echo $description; ?></textarea>
						  </div>
						</div>
						<div class="col-6">
						  <div class="form-group">
							<label for="enterproductname">Enter Product Meta Description</label>
							<textarea name="meta_desc" type="text" class="form-control" placeholder="Enter Product Name"><?php echo $meta_desc; ?></textarea>
						  </div>
						</div>
						<div class="col-6">
						  <div class="form-group">
							<label for="enterproductname">Enter Product Meta Title</label>
							<textarea name="meta_title" type="text" class="form-control" placeholder="Enter Product Name"><?php echo $meta_title; ?></textarea>
						  </div>
						</div>
						<div class="col-6">
						  <div class="form-group">
							<label for="enterproductname">Enter Product Meta Keyword</label>
							<textarea name="meta_keyword" type="text" class="form-control" placeholder="Enter Product Name"><?php echo $meta_keyword; ?></textarea>
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
<script>
			function get_sub_cat(sub_cat_id){
				var categories_id=jQuery('#categories_id').val();
				jQuery.ajax({
					url:'get_sub_cat.php',
					type:'post',
					data:'categories_id='+categories_id+'&sub_cat_id='+sub_cat_id,
					success:function(result){
						jQuery('#sub_categories_id').html(result);
					}
				});
			}
		 </script>
  <script>
	var total_image=1;
	
	function add_more_images(){
		total_image++;
	//	alert('s');
	var html='<div class="col-8" id="add_image_box_'+total_image+'"><div class="form-group"><label for="productphoto">Product Photo</label><input name="product_images[]" type="file" class="form-control" required></div><div class="col-4"><button type="button" class="btn btn-danger" onClick=remove_image("'+total_image+'")>Remove</button></div></div>';
	jQuery('#image_box').after(html);
	}
	
	function remove_image(id){
	//	alert('s');
	jQuery('#add_image_box_'+id).remove();
	}
	
	
	
	var attr_count=1;
	function add_more_attr(){
	    attr_count++;
	    
	    
	    var size_html=jQuery('#attr_1 #size_id').html();
	    size_html=size_html.replace('selected','');
	    var color_html=jQuery('#attr_1 #color_id').html();
	    color_html=color_html.replace('selected','');
    //    console.log(size_html);
	    
	   	//	alert('s');
	    var html='<div class="row" id="attr_'+attr_count+'"><div class="col-2"><div class="form-group"><label for="productmrp">Product MRP</label><input name="mrp[]" type="text" id="mrp" class="form-control" placeholder="Product MRP"></div></div><div class="col-2"><div class="form-group"><label for="productprice">Product Price</label><input name="price[]" type="text" id="price" class="form-control" placeholder="Product Price"></div></div><div class="col-2"><div class="form-group"><label for="productqty">Product QTY</label><input name="qty[]" type="text" id="qty" class="form-control" placeholder="Product QTY"></div></div><div class="col-2"><div class="form-group"><label for="productsize">Product Size</label><select class="form-control" name="size_id[]" id="size_id">'+size_html+'</select></div></div><div class="col-2"><div class="form-group"><label for="productcolor">Product Color</label><select class="form-control" name="color_id[]" id="color_id">'+color_html+'</select></div></div><div class="col-2"><div class="form-group"><label for="productattr"></label><br><button type="button" onClick=remove_attr("'+attr_count+'") class="btn btn-danger">Remove</button></div><input type="hidden" name="attr_id[]" value=""/></div></div>';
    	jQuery('#product_attr_box').append(html);
    }
    
    
    
    
    function remove_attr(attr_count,id){
    //    alert(attr_count);
        jQuery.ajax({
            url:'remove_product_attr.php',
            data:'id='+id,
            type:'post',
            success:function(result){
            	jQuery('#attr_'+attr_count).remove();
            }
        });
        jQuery('#attr_'+attr_count).remove();
    }

</script>


<?php require('footer.php'); ?>
<?php
ob_end_flush();
?>
<script>
<?php
	if(isset($_GET['id'])){
?>	
	get_sub_cat('<?php echo $sub_categories_id ?>');
<?php
	}				
?>
</script>
						