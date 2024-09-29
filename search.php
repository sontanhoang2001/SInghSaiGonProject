<?php 
require('header.php');
$str=mysqli_real_escape_string($con,$_GET['str']);
if($str!=''){
	$get_product=get_product($con,'','','','','','','','','','','','',$str);
}else{
	?>
	
	<script>
	window.location.href='index.php';
	</script>
	<?php
}										
?>
 <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2><?php echo $str?></h2>
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