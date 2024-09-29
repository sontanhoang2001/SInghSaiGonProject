<?php 
require('header.php'); ?>
<?php 

if(isset($_GET['id'])){
	$product_id=mysqli_real_escape_string($con,$_GET['id']);
	if($product_id>0){
		$get_product=get_product($con,'','',$product_id);
	}else{
		?>
		<script>
		window.location.href='index.php';
		</script>
		<?php
	}
	
	// Product Image	
	$resMultipleImages=mysqli_query($con,"select product_images from product_images where product_id='$product_id'");
	$multipleImages=[];
	if(mysqli_num_rows($resMultipleImages)>0){
		while($rowMultipleImages=mysqli_fetch_assoc($resMultipleImages)){
			$multipleImages[]=$rowMultipleImages['product_images'];
		}
	}
	// Product Image
	
}else{
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}
?>
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2><?php echo $get_product['0']['name']?></h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.php">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                  
                                <li class="breadcrumb-item active"><a class="breadcrumb-item" href="categories.php?id=<?php echo $get_product['0']['categories_id']?>"><?php echo $get_product['0']['categories']?></a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Left Sidebar Start -->
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-lg-12 wow fadeInUp">
                    <div class="row g-4">
                        <div class="col-xl-6 wow fadeInUp">
                            <div class="product-left-box">
                                <div class="row g-2">
                                    <div class="col-xxl-10 col-lg-12 col-md-10 order-xxl-2 order-lg-1 order-md-2">
                                        <div class="product-main-2 no-arrow">
                                            <div>
                                                <div class="slider-image">
                                                    <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$get_product['0']['image']?>" id="img-1"
                                                        data-zoom-image="<?php echo PRODUCT_IMAGE_SITE_PATH.$get_product['0']['image']?>"
                                                        class="img-fluid image_zoom_cls-0 blur-up lazyload" style="height:400px; width:100%;" alt="">
                                                </div>
                                            </div>

                                            
                                            <?php if(isset($multipleImages[0])){?>
                                            <?php
						foreach($multipleImages as $list){
                                                echo "<div>
                                                <div class='slider-image'>
                                                    <img src='".'singh/media/product/'.$list."'
                                                        data-zoom-image='".'singh/media/product/'.$list."'
                                                        class='img-fluid image_zoom_cls-1 blur-up lazyload'>
                                                </div>
                                            </div>";
						}
					?>
                                            
                                            
                                            <?php } ?>
                                            

                                            
                                        </div>
                                    </div>

                                    <div class="col-xxl-2 col-lg-12 col-md-2 order-xxl-1 order-lg-2 order-md-1">
                                        <div class="left-slider-image-2 left-slider no-arrow slick-top">
                                            <div><div class='sidebar-image'>
                                                    <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$get_product['0']['image']?>"
                                                        class="img-fluid blur-up lazyload" >
                                                </div></div>
                                            
                                            <?php if(isset($multipleImages[0])){?>
                                            <?php
						                    foreach($multipleImages as $list){
                                                echo "<div><div class='sidebar-image'>
                                                    <img src='".'singh/media/product/'.$list."'
                                                        class='img-fluid blur-up lazyload' style='height:100px;width:100%;' >
                                                </div></div>";
                        						}
                        					?>
                                            <?php } ?>

                                            
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="right-box-contain">
                                
                                <h2 class="name"><?php echo $get_product['0']['name']?></h2>
                                <div class="price-rating">
                                    <h3 class="theme-color price"><?php echo $get_product['0']['price']?><del class="text-content"><?php echo $get_product['0']['mrp']?></del> <span
                                            class="offer theme-color">(<?php echo $get_product['0']['discount']?>% off)</span></h3>
                                    <div class="product-rating custom-rate">
                                        <ul class="rating">
                                            <li>
                                                <i data-feather="star" class="fill"></i>
                                            </li>
                                            <li>
                                                <i data-feather="star" class="fill"></i>
                                            </li>
                                            <li>
                                                <i data-feather="star" class="fill"></i>
                                            </li>
                                            <li>
                                                <i data-feather="star" class="fill"></i>
                                            </li>
                                            <li>
                                                <i data-feather="star"></i>
                                            </li>
                                        </ul>
                                        <span class="review">23 Customer Review</span>
                                    </div>
                                </div>
                                <div class="product-contain">
                                    <p><?php echo $get_product['0']['gklp']?>
                                    </p>
                                </div>
                                <div class="product-contain">
                                    <p><?php echo $get_product['0']['short_desc']?>
                                    </p>
                                </div>

                                <div class="note-box product-package">
                                    <div class="cart_qty qty-box product-qty">
                                        <div class="input-group">
                                            <select id="qty">
											<option>1</option>
											<option>2</option>
											<option>3</option>
											<option>4</option>
											<option>5</option>
											<option>6</option>
											<option>7</option>
											<option>8</option>
											<option>9</option>
											<option>10</option>
										</select>
                                        </div>
                                    </div>

                                    <a href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['id']?>','add')"
                                        class="btn btn-md bg-dark cart-button text-white w-100">Add To Cart</a>
                                </div>

                               
                                <div class="buy-box">
                                    <a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $get_product['0']['id']?>','add')">
                                        <i data-feather="heart"></i>
                                        <span>Add To Wishlist</span>
                                    </a>

                                    <a href="#">
                                        <i data-feather="shuffle"></i>
                                        <span>Add To Compare</span>
                                    </a>
                                </div>

                                

                                
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="product-section-box">
                                <ul class="nav nav-tabs custom-nav" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                            data-bs-target="#description" type="button" role="tab">Description</button>
                                    </li>

                                </ul>

                                <div class="tab-content custom-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                                        <div class="product-description">
                                            <div class="nav-desh">
                                                <p><?php echo $get_product['0']['description']?></p>
                                            </div>

                                            

                                            

                                            
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    </section>
    <!-- Product Left Sidebar End -->
<br><br>
    
    
    
<?php require('footer.php'); ?>