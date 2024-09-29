<?php 
require('header.php');
if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0){
	?>
	<script>
		window.location.href='index.php';
	</script>
	<?php
}

$cart_total=0;

if(isset($_POST['submit'])){
	$address=get_safe_value($con,$_POST['address']);
	$city=get_safe_value($con,$_POST['city']);
	$pincode=get_safe_value($con,$_POST['pincode']);
	$payment_type=get_safe_value($con,$_POST['payment_type']);
	$user_id=$_SESSION['USER_ID'];
	foreach($_SESSION['cart'] as $key=>$val){
		$productArr=get_product($con,'','',$key);
		$price=$productArr[0]['price'];
		$qty=$val['qty'];
		$cart_total=$cart_total+($price*$qty);
		
	}
	$total_price=$cart_total;
	$payment_status='pending';
	if($payment_type=='cod'){
		$payment_status='success';
	}
	$order_status='pending';
	$added_on=date('Y-m-d h:i:s');
	
	
	mysqli_query($con,"insert into `order`(user_id,address,city,pincode,payment_type,payment_status,order_status,added_on,total_price) values('$user_id','$address','$city','$pincode','$payment_type','$payment_status','$order_status','$added_on','$total_price')");
	
	$order_id=mysqli_insert_id($con);
	
	foreach($_SESSION['cart'] as $key=>$val){
		$productArr=get_product($con,'','',$key);
		$price=$productArr[0]['price'];
		$qty=$val['qty'];
		
		mysqli_query($con,"insert into `order_detail`(order_id,product_id,qty,price) values('$order_id','$key','$qty','$price')");
	}
	
	unset($_SESSION['cart'])
	?>
	<script>
		window.location.href='thank_you.php';
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
                        <h2>Checkout</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.php">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Checkout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout section Start -->
    <section class="checkout-section-2 section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-lg-8">
                    <div class="left-sidebar-checkout">
                        <div class="checkout-detail-box">
                            <ul>
                                <?php if(isset($_SESSION['USER_LOGIN'])){ ?>
                                
                                <li>
                                    <div class="checkout-icon">
                                        <lord-icon target=".nav-item" src="https://cdn.lordicon.com/qmcsqnle.json" trigger="loop-on-hover" colors="primary:#0baf9a,secondary:#0baf9a" class="lord-icon"></lord-icon>
                                    </div>
                                    <form  method="post">
                                    <div class="checkout-box">
                                        <div class="checkout-title">
                                            <h4>Please Fill Details</h4>
                                        </div>

                                        <div class="checkout-detail">
                                            <div class="accordion accordion-flush custom-accordion"  id="accordionFlushExample">
                                                <label for="address">Address</label>
                                                <input type="text" name="address" class="form-control" placeholder="Address" required>
                                                <label for="city">City</label>
                                                <input type="text" name="city" class="form-control" placeholder="City" required>
                                                <label for="pincode">Pincode</label>
                                                <input type="text" name="pincode" class="form-control" placeholder="Pincode" required>                             

                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="checkout-box">
                                        <div class="checkout-title">
                                            <h4>Select Payment Option</h4>
                                        </div>

                                        <div class="checkout-detail">
                                            <div class="row g-4">
                                                <div class="col-xxl-6">
                                                    <div class="delivery-option">
                                                        <div class="delivery-category">
                                                            <div class="shipment-detail">
                                                                <div
                                                                    class="form-check custom-form-check hide-check-box">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="payment_type" value="payu" checked>
                                                                    <label class="form-check-label"
                                                                        for="standard">Online Payment</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xxl-6">
                                                    <div class="delivery-option">
                                                        <div class="delivery-category">
                                                            <div class="shipment-detail">
                                                                <div
                                                                    class="form-check mb-0 custom-form-check show-box-checked">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="payment_type" value="COD" >
                                                                    <label class="form-check-label" for="future">Cash On Delivery Payment</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><br>
                                                    <div class="button-group mt-0">
                                                                    <ul>
                                                                        <li>
                                                                          
                                                                            <button class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold" type="submit" name="submit">Place Order</button>
                                                                        </li>

                                                                    </ul>
                                                                    
                                            </div>
                                                </div>
                                            
                                                
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                    
                                </li>


                                <?php
                                    }else{
                                    echo '
                                <li>
                                    <div class="checkout-icon">
                                        <lord-icon target=".nav-item" src="https://cdn.lordicon.com/qmcsqnle.json" trigger="loop-on-hover" colors="primary:#0baf9a,secondary:#0baf9a" class="lord-icon"></lord-icon>
                                    </div>
                                    <div class="checkout-box">
                                        <div class="checkout-title">
                                            <h4>Login Details</h4>
                                        </div>

                                        <div class="checkout-detail">
                                            <div class="accordion accordion-flush custom-accordion"  id="accordionFlushExample">
                                            <form class="row g-4" id="login-form" action="#" method="post">
                                                <label for="email">Email Id</label>
                                                <input type="text" name="login_email" id="login_email" class="form-control" placeholder="Email Id" required>
                                                <span class="field_error" id="login_email_error"></span><br>
                                                <label for="password">Password</label>
                                                <input type="password"  name="login_password" id="login_password" class="form-control" placeholder="Password" required>   <br>       
                                                <span class="field_error" id="login_password_error"></span><br>
                                            <div class="button-group mt-0">
                                                                    <ul>
                                                                        <li>
                                                                            <button class="btn btn-light shopping-button">Register Now</button>
                                                                        </li>

                                                                        <li>
                                                                            <button type="button" onclick="user_login()" class="btn btn-animation">Login Now</button>
                                                                        </li>
                                                                    </ul>
                                                                    
                                            </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>';
                                            		}		
                                            		?>

                               
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="right-side-summery-box">
                        <div class="summery-box-2">
                            <div class="summery-header">
                                <h3>Order Summery</h3>
                            </div>
                            
                            <ul class="summery-contain">
                                <?php
                                $qty_total=0;
								$cart_total=0;
								foreach($_SESSION['cart'] as $key=>$val){
								$productArr=get_product($con,'','',$key);
								$pname=$productArr[0]['name'];
								$mrp=$productArr[0]['mrp'];
								$price=$productArr[0]['price'];
								$image=$productArr[0]['image'];
								$qty=$val['qty'];
								$cart_total=$cart_total+($price*$qty);
								$qty_total=$qty_total+$qty;
								?>
                                <li>
                                    <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image?>" style="height:50px;"
                                        class="img-fluid blur-up lazyloaded checkout-image" alt="">
                                    <h4><?php echo $pname?> <span>X <?php echo $qty?> </span></h4>
                                    <h4 class="price"><?php echo $price*$qty?></h4>
                                </li>
                                
                                <?php } ?>

                               
                            </ul>

                            <ul class="summery-total">
                                <li>
                                    <h4>Subtotal</h4>
                                    <h4 class="price"><?php echo $cart_total?></h4>
                                </li>

                                <li>
                                    <h4>Total Items</h4>
                                    <h4 class="price"><?php echo $qty_total?></h4>
                                </li>
                            <!--    
                                <li>
                                    <h4>Tax</h4>
                                    <h4 class="price">$29.498</h4>
                                </li>

                                <li>
                                    <h4>Coupon/Code</h4>
                                    <h4 class="price">$-23.10</h4>
                                </li>
                            -->
                                <li class="list-total">
                                    <h4>Total Price</h4>
                                    <h4 class="price"><?php echo $cart_total?></h4>
                                </li>
                            </ul>
                        </div>
                
                    <!--<div class="checkout-offer">
                            <div class="offer-title">
                                <div class="offer-icon">
                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/inner-page/offer.svg" class="img-fluid" alt="">
                                </div>
                                <div class="offer-name">
                                    <h6>Available Offers</h6>
                                </div>
                            </div>

                            <ul class="offer-detail">
                                <li>
                                    <p>Combo: BB Royal Almond/Badam Californian, Extra Bold 100 gm...</p>
                                </li>
                                <li>
                                    <p>combo: Royal Cashew Californian, Extra Bold 100 gm + BB Royal Honey 500 gm</p>
                                </li>
                            </ul>
                        </div>
                   
                        <button class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold">Place Order</button>  -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout section End -->
<?php include('footer.php'); ?>