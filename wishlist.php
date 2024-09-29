<?php require('header.php');
// prx($_SESSION);

if(!isset($_SESSION['USER_LOGIN'])){
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}
$uid=$_SESSION['USER_ID'];

$res=mysqli_query($con,"select product.name,product.image,product.price,product.mrp,wishlist.id from product,wishlist where wishlist.product_id=product.id and wishlist.user_id='$uid'");

?>

    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Wishlist</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.php">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Wishlist</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Cart Section Start -->
    <section class="cart-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-5 g-3">
                <div class="col-xxl-9">
                    <div class="cart-table">
                        <div class="table-responsive-xl">
                            <table class="table">
                                
                                <tbody>
                                    
                                    
                                     <?php
										while($row=mysqli_fetch_assoc($res)){
										?>
                                    
                                    
                                    <tr class="product-box-contain">
                                        <td class="product-detail">
                                            <div class="product border-0">
                                                <a href="#" class="product-image">
                                                    <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>"  style="height:50px;"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                                
                                            </div>
                                        </td>
                                        <td class="price">
                                            <h4 class="table-title text-content">Name</h4>
                                            <h5><?php echo $row['name']?></h5>
                                        </td>
                                        <td class="price">
                                            <h4 class="table-title text-content">Price</h4>
                                            <h5><?php echo $row['price']?></h5>
                                        </td>

                                        <td class="quantity">
                                            <h4 class="table-title text-content">MRP</h4>
                                            <h5><?php echo $row['mrp']?></h5>
                                        </td>

                                        
                                        <td class="save-remove">
                                            <h4 class="table-title text-content">Action</h4>
                                            
                                            <a class="remove close_button" href="wishlist.php?wishlist_id=<?php echo $row['id']?>" >Remove</a>
                                        </td>
                                    </tr>
                                     <?php } ?>



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                
                
                
                

                <div class="col-xxl-3">
                    <div class="summery-box p-sticky">
                        <div class="summery-header">
                            
                        </div>

                        <div class="button-group cart-button">
                            <ul>
                                <li>
                                    <a href="<?php echo SITE_PATH?>checkout.php"
                                        class="btn btn-animation proceed-btn fw-bold">Process To Checkout</a>
                                </li>

                                <li>
                                    <a href="<?php echo SITE_PATH?>"
                                        class="btn btn-light shopping-button text-dark">
                                        <i class="fa-solid fa-arrow-left-long"></i>Return To Shopping</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Cart Section End -->
<?php require('footer.php'); ?>