
<?php
	require('header.php'); 

    if(!isset($_GET['id']) && $_GET['id']!=''){
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
	}
	
	$cat_id=mysqli_real_escape_string($con,$_GET['id']);
	
	$sub_categories='';
	if(isset($_GET['sub_categories'])){
		$sub_categories=mysqli_real_escape_string($con,$_GET['sub_categories']);
	}
	
	$price_high_selected="";
	$price_low_selected="";
	$new_selected="";
	$old_selected="";
	$sort_order="";
	
	if(isset($_GET['sort'])){
		$sort=mysqli_real_escape_string($con,$_GET['sort']);
		if($sort=="price_high"){
			$sort_order=" order by product.price desc ";
			$price_high_selected="selected";
		}
		if($sort=="price_low"){
			$sort_order=" order by product.price asc ";
			$price_low_selected="selected";
		}
		if($sort=="new"){
			$sort_order=" order by product.id desc ";
			$new_selected="selected";
		}
		if($sort=="old"){
			$sort_order=" order by product.id asc ";
			$old_selected="selected";
		}
	}
	
	if($cat_id>0){
		$get_product=get_product($con,'',$cat_id,'','','','','','','','','','','',$sort_order,$sub_categories);
	}else{ ?>
	<script>
	window.location.href='index.php';
	</script>
		<!-- header('location:index.php');
		 die(); -->
<?php	}	
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
                                <li class="breadcrumb-item active"><?php echo $get_product['0']['categories']?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shop Section Start -->
    <section class="section-b-space shop-section">
        <div class="container-fluid-lg">
            <div class="row">
                <?php if(count($get_product)>0){?>

                <div class="col-custom-12 wow fadeInUp">
                    <div class="show-button">
                        <div class="filter-button-group mt-0">
                            <div class="filter-button d-inline-block d-lg-none">
                                <a><i class="fa-solid fa-filter"></i> Filter Menu</a>
                            </div>
                        </div>

                        <div class="top-filter-menu">
                            <div class="category-dropdown">
                                <h5 class="text-content">Sort By :</h5>
                                <div class="dropdown">
                                    <select onchange="sort_product_drop('<?php echo $cat_id?>','<?php echo SITE_PATH?>')" id="sort_product_id">
                                        <option value="">Default softing</option>
                                        <option value="price_low" <?php echo $price_low_selected?>>Sort by price low to hight</option>
                                        <option value="price_high" <?php echo $price_high_selected?>>Sort by price high to low</option>
                                        <option value="new" <?php echo $new_selected?>>Sort by new first</option>
										<option value="old" <?php echo $old_selected?>>Sort by old first</option>
                                    </select>
                                    
                                </div>
                            </div>

                            
                        </div>
                    </div>

                    <div class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">
                        
                        
                        <?php
										foreach($get_product as $list){
										?>
                        
                        <div>
                            <div class="product-box-3 h-100 wow fadeInUp">
                                <div class="product-header">
                                    <div class="product-image">
                                        <a href="product.php?id=<?php echo $list['id']?>">
                                            <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image']?>"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </a>

                                        
                                    </div>
                                </div>
                                <div class="product-footer">
                                    <div class="product-detail">
                                        
                                        <a href="product.php?id=<?php echo $list['id']?>">
                                            <h5 class="name"><?php echo $list['name']?></h5>
                                        </a>
                                        
                                        <div class="product-rating mt-2">
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
                                            <span>(4.0)</span>
                                        </div>
                                        <h6 class="unit">250 ml</h6>
                                        <h5 class="price"><span class="theme-color"><?php echo $list['price']?></span> <del><?php echo $list['mrp']?></del>
                                        </h5>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        
                        
                        
                        
                        
                        

                    </div>

                    
                </div>
                
                <?php } else { 
						echo "Data not found";
					} ?>
                
                
                
            </div>
        </div>
    </section>
    <!-- Shop Section End -->
    
    <input type="hidden" id="qty" value="1"/>
<?php require('footer.php'); ?>