<?php require('header.php');
// prx($_SESSION);
?>

    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Cart</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.php">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Cart</li>
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
										if(isset($_SESSION['cart'])){
										    $cart_total=0;
										    $qty_total=0;
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
                                    
                                    
                                    <tr class="product-box-contain">
                                        <td class="product-detail">
                                            <div class="product border-0">
                                                <a href="#" class="product-image">
                                                    <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image?>"  style="height:50px;"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                                <div class="product-detail">
                                                    <ul>
                                                        <li class="name">
                                                            <a href="#"><?php echo $pname?></a>
                                                        </li>

                                                        <li class="text-content"><span class="text-title">Sold
                                                                By:</span> <?php echo $pname?></li>

                                                        <li class="text-content"><span
                                                                class="text-title">Quantity</span> - <?php echo $qty?></li>

                                                        <li>
                                                            <h5 class="text-content d-inline-block">Price :</h5>
                                                            <span><?php echo $price?></span>
                                                            
                                                        </li>

                                                       

                                                        <li class="quantity-price-box">
                                                            <div class="cart_qty">
                                                                <div class="input-group">
                                                                    <button type="button" class="btn qty-left-minus"
                                                                        data-type="minus" data-field="">
                                                                        <i class="fa fa-minus ms-0"></i>
                                                                    </button>
                                                                    <input class="form-control input-number qty-input"
                                                                        type="number" id="<?php echo $key?>qty" value="<?php echo $qty?>">
                                                                    <button type="button" class="btn qty-right-plus"
                                                                        data-type="plus" data-field="">
                                                                        <i class="fa fa-plus ms-0"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <h5>Total: <?php echo $qty*$price?></h5>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="price">
                                            <h4 class="table-title text-content">Price</h4>
                                            <h5><?php echo $price?></h5>
                                        </td>

                                        <td class="quantity">
                                            <h4 class="table-title text-content">Qty</h4>
                                            <div class="quantity-price">
                                                <div class="cart_qty">
                                                    <div class="input-group">
                                                        <button type="button" class="btn qty-left-minus"
                                                            data-type="minus" data-field="">
                                                            <i class="fa fa-minus ms-0"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="number" id="<?php echo $key?>qty" value="<?php echo $qty?>">
                                                        <button type="button" class="btn qty-right-plus"
                                                            data-type="plus" data-field="">
                                                            <i class="fa fa-plus ms-0"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="subtotal">
                                            <h4 class="table-title text-content">Total</h4>
                                            <h5><?php echo $qty*$price?></h5>
                                        </td>

                                        <td class="save-remove">
                                            <h4 class="table-title text-content">Action</h4>
                                            <a class="save" href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','update')">Update Now</a>
                                            <a class="remove close_button" href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','remove')">Remove</a>
                                        </td>
                                    </tr>
                                     <?php } } ?>



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                
                
                
                

                <div class="col-xxl-3">
                    <div class="summery-box p-sticky">
                        <div class="summery-header">
                            <h3>Cart Total</h3>
                        </div>

                        <div class="summery-contain">
                           <!-- <div class="coupon-cart">
                                <h6 class="text-content mb-2">Coupon Apply</h6>
                                <div class="mb-3 coupon-box input-group">
                                    <input type="email" class="form-control" id="exampleFormControlInput1"
                                        placeholder="Enter Coupon Code Here...">
                                    <button class="btn-apply">Apply</button>
                                </div>
                            </div> -->
                            <ul>
                                <li>
                                    <h4>Subtotal</h4>
                                    <h4 class="price"><?php echo $cart_total?></h4>
                                </li>

                                <li>
                                    <h4>Total Items</h4>
                                    <h4 class="price"> <?php echo $qty_total?></h4>
                                </li>

                            </ul>
                        </div>

                        <ul class="summery-total">
                            <li class="list-total border-top-0">
                                <h4>Total</h4>
                                <h4 class="price theme-color"><?php echo $cart_total?></h4>
                            </li>
                        </ul>

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