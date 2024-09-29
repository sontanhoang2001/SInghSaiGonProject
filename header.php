<?php
require('connection.inc.php');
require('functions.inc.php');
require('add_to_cart.inc.php');

$wishlist_count=0;

$cat_res=mysqli_query($con,"select * from categories where status=1 order by created_at desc");
$cat_arr=array();
while($row=mysqli_fetch_assoc($cat_res)){
	$cat_arr[]=$row;
}


$obj=new add_to_cart();
$totalProduct=$obj->totalProduct();

if(isset($_SESSION['USER_LOGIN'])){
	$uid=$_SESSION['USER_ID'];
	
	if(isset($_GET['wishlist_id'])){
		$wid=get_safe_value($con,$_GET['wishlist_id']);
		mysqli_query($con,"delete from wishlist where id='$wid' and user_id='$uid'");
	}

	$wishlist_count=mysqli_num_rows(mysqli_query($con,"select product.name,product.image,product.price,product.mrp,wishlist.id from product,wishlist where wishlist.product_id=product.id and wishlist.user_id='$uid'"));
}

?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Singh Saigon">
    <meta name="keywords" content="Singh Saigon">
    <meta name="author" content="Singh Saigon">
    <link rel="icon" href="assets/images/favicon/1.png" type="image/x-icon">
    <title>Online Indian Grocery in Veitnam</title>

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
		
    <!--
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
	-->	
	<link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap">

    <!-- bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">

    <!-- wow css -->
    <link rel="stylesheet" href="assets/css/animate.min.css">

    <!-- Iconly css -->
    <link rel="stylesheet" type="text/css" href="assets/css/bulk-style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/animate.css">

    <!-- Template css -->
    <link id="color-link" rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body class="bg-effect">

    <!-- Loader Start -->
    <div class="fullpage-loader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <!-- Loader End -->

    <!-- Header Start -->
    <header class="pb-md-4 pb-0">
        <div class="header-top">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-xxl-3 d-xxl-block d-none">
                        <div class="top-left-header">
                            <i class="iconly-Location icli text-white"></i>
                            <span class="text-white">1418 Riverwood Drive, CA 96052, US</span>
                        </div>
                    </div>

                    <div class="col-xxl-6 col-lg-9 d-lg-block d-none">
                        <div class="header-offer">
                            <div class="notification-slider">
                                <div>
                                    <div class="timer-notification">
                                        <h6><strong class="me-1">Welcome to Singh Saigon!</strong>Wrap new offers/gift
                                            every single day on Weekends.<strong class="ms-1">New Coupon Code: Fast024
                                            </strong>

                                        </h6>
                                    </div>
                                </div>

                                <div>
                                    <div class="timer-notification">
                                        <h6>Something you love is now on sale!
                                            <a href="shop-left-sidebar.html" class="text-white">Buy Now
                                                !</a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <ul class="about-list right-nav-about">
                        <li class="right-nav-list">
                        <div id="google_element"></div>
                        <script src="https://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate"></script>
                        <script>
                            function loadGoogleTranslate() {
                                new google.translate.TranslateElement({
                                    //pageLanguage: 'en', // Default language of the webpage
                                    includedLanguages: 'en,vi', // Languages to include in the dropdown
                                    layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                                    autoDisplay: false // Prevents automatic translation based on browser settings
                                }, 'google_element');
                            }
                        </script>
                    </li>
                           
                           <!-- <li class="right-nav-list">
                                <div class="dropdown theme-form-select">
                                    <button class="btn dropdown-toggle" type="button" id="select-language"
                                        data-bs-toggle="dropdown">
                                        <img src="assets/images/country/united-states.png"
                                            class="img-fluid blur-up lazyload" alt="">
                                        <span>English</span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0)" id="english">
                                                <img src="assets/images/country/united-kingdom.png"
                                                    class="img-fluid blur-up lazyload" alt="">
                                                <span>English</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0)" id="france">
                                                <img src="assets/images/country/germany.png"
                                                    class="img-fluid blur-up lazyload" alt="">
                                                <span>Germany</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0)" id="chinese">
                                                <img src="assets/images/country/turkish.png"
                                                    class="img-fluid blur-up lazyload" alt="">
                                                <span>Turki</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li> -->
                            <li class="right-nav-list">
                                <div class="dropdown theme-form-select">
                                    <button class="btn dropdown-toggle" type="button" id="select-dollar"
                                        data-bs-toggle="dropdown">
                                        <span>USD</span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end sm-dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" id="aud" href="javascript:void(0)">AUD</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="eur" href="javascript:void(0)">EUR</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="cny" href="javascript:void(0)">CNY</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="top-nav top-header sticky-header">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="navbar-top">
                            <button class="navbar-toggler d-xl-none d-inline navbar-menu-button" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
                                <span class="navbar-toggler-icon">
                                    <i class="fa-solid fa-bars"></i>
                                </span>
                            </button>
                            <a href="index.php" class="web-logo nav-logo">
                              <!--  <span style="color:red;">Singh</span><span style="color:green;"> Saigon</span> -->
                                <img src="assets/photo/logos.jpg" class="img-fluid blur-up lazyload" alt="" style="height:50px;"> 
                            </a>

                            <div class="middle-box">
                                <!-- <div class="location-box">
                                    <button class="btn location-button" data-bs-toggle="modal"
                                        data-bs-target="#locationModal">
                                        <span class="location-arrow">
                                            <i data-feather="map-pin"></i>
                                        </span>
                                        <span class="locat-name">Your Location</span>
                                        <i class="fa-solid fa-angle-down"></i>
                                    </button>
                                </div> -->

                                <div class="search-box">
                                    <form action="search.php" method="get">
                                    <div class="input-group">
                                        
                                        <input type="text" name="str" class="form-control" placeholder="I'm searching for...">
                                        <button class="btn" type="submit" id="button-addon2">
                                            <i data-feather="search"></i>
                                        </button>
                                        
                                    </div></form>
                                </div>
                            </div>

                            <div class="rightside-box">
                                <div class="search-full">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i data-feather="search" class="font-light"></i>
                                        </span>
                                        <input type="text" class="form-control search-type" placeholder="Search here..">
                                        <span class="input-group-text close-search">
                                            <i data-feather="x" class="font-light"></i>
                                        </span>
                                    </div>
                                </div>
                                <ul class="right-side-menu">
                                    <li class="right-side">
                                        <div class="delivery-login-box">
                                            <div class="delivery-icon">
                                                <div class="search-box">
                                                    <i data-feather="search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="right-side">
                                        <a href="contact-us.php" class="delivery-login-box">
                                            <div class="delivery-icon">
                                                <i data-feather="phone-call"></i>
                                            </div>
                                            <div class="delivery-detail">
                                                <h6>24/7 Delivery</h6>
                                                <h5>+91 888 104 2340</h5>
                                            </div>
                                        </a>
                                    </li>
                                   <?php
										if(isset($_SESSION['USER_ID'])){
										?>
                                    <li class="right-side">
                                        <a href="wishlist.php" class="btn p-0 position-relative header-wishlist">
                                            <i data-feather="heart"></i><span class="htc__wishlist"><?php echo $wishlist_count?></span>
                                        </a>
                                    </li>
                                    <?php } ?>
                                    <li class="right-side">
                                        <div class="onhover-dropdown header-badge">
                                            <button type="button" class="btn p-0 position-relative header-wishlist">
                                                <i data-feather="shopping-cart"></i>
                                                <span class="position-absolute top-0 start-100 translate-middle badge htc__qua"><span class="htc__qua"> <?php echo $totalProduct?></span>
                                                    <span class="visually-hidden htc__qua"> unread messages</span>
                                                </span>
                                            </button>

                                            <div class="onhover-div">
                                                <ul class="cart-list">
                                                     <?php
                										if(isset($_SESSION['cart'])){
                										    $cart_total=0;
                										    $qty_total=0;
                											foreach($_SESSION['cart'] as $key=>$val){
                											$productArr=get_product($con,'','',$key);
                											$name=$productArr[0]['name'];
                											$mrp=$productArr[0]['mrp'];
                											$price=$productArr[0]['price'];
                											$image=$productArr[0]['image'];
                											$qty=$val['qty'];
                											$cart_total=$cart_total+($price*$qty);
                											$qty_total=$qty_total+$qty;
                									?>
                                    
                                                    <li class="product-box-contain">
                                                        <div class="drop-cart">
                                                            <a href="#" class="drop-image">
                                                                <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image?>"
                                                                    class="blur-up lazyload" alt="">
                                                            </a>

                                                            <div class="drop-contain">
                                                                <a href="#">
                                                                    <h5><?php echo $name?></h5> 
                                                                </a>
                                                                <h6><span><?php echo $qty?> x</span> <?php echo $price?></h6>
                                                                <button class="close-button close_button">
                                                                    <a class="remove close_button" href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','remove')"><i class="fa-solid fa-xmark"></i></a>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <?php } } ?>
                                                    
                                                </ul>

                                                <div class="price-box">
                                                    <h5>Total :</h5>
                                                    <h4 class="theme-color fw-bold"><?php echo $cart_total?></h4>
                                                </div>
                                                
                                                <div class="button-group">
                                                    <a href="cart.php" class="btn btn-sm cart-button">View Cart</a>
                                                    <a href="checkout.php" class="btn btn-sm cart-button theme-bg-color
                                                    text-white">Checkout</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="right-side onhover-dropdown">
                                       
                                        <div class="delivery-login-box">
                                            <div class="delivery-icon">
                                                Login Now
                                            </div>
                                            <div class="delivery-detail">
                                                <h6>Hello,<?php echo $_SESSION['USER_NAME']?></h6>
                                                <h5>My Account</h5>
                                            </div>
                                        </div>
                                   <div class="onhover-div onhover-div-login">
                                       
                                            <ul class="user-box-name">
                                             <?php if(isset($_SESSION['USER_LOGIN'])){ ?>
                                             <h6>Hello,<?php echo $_SESSION['USER_NAME']?></h6>
                                                    <li class="product-box-contain"><i></i> <a href="logout.php">Logout</a> </li>
                                                 <?php
                                            		}else{
                                                    echo '
                                                <li class="product-box-contain ">
                                                    <i></i>
                                                    <a href="login.php">Log In</a>
                                                </li>

                                                <li class="product-box-contain">
                                                    <a href="register.php">Register</a>
                                                </li>';
                                            		}		
                                            		?>
                                            </ul>
                                        </div>
                                        
                                        
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="header-nav">
                        <div class="header-nav-left">
                            <button class="dropdown-category">
                                <i data-feather="align-left"></i>
                                <span>All Categories</span>
                            </button>

                            <div class="category-dropdown">
                                <div class="category-title">
                                    <h5>Categories</h5>
                                    <button type="button" class="btn p-0 close-button text-content">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>

                                <ul class="category-list">
                                    
                                    
                                    
                                     <?php
                                				foreach($cat_arr as $list){
                                			?>
                                    
                                    
                                    
                                    <li class="onhover-category-list">
                                        <a href="javascript:void(0)" class="category-name">
                                            <img src="https://themes.pixelstrap.com/fastkart/assets/svg/1/vegetable.svg" alt="">
                                            <h6><?php echo $list['categories']; ?></h6>
                                            <i class="fa-solid fa-angle-right"></i>
                                        </a>

                                        <div class="onhover-category-box">
                                            <div class="list-1">
                                                <?php
                                        			  $cat_id=$list['id'];
                                        			//  echo "select * from sub_categories where status='1' and categories='$cat_id'"; (categories_id='$cat_id')
                                        			  $sub_cat_res=mysqli_query($con,"select * from sub_categories where status='1' and categories_id='$cat_id'");
                                        			  if(mysqli_num_rows($sub_cat_res)>0){
                                        			  ?>
                                                <ul>
                                                    <?php while($sub_cat_rows=mysqli_fetch_assoc($sub_cat_res)){
                                                    echo '<li>
                                                        <a href="category.php?id='.$list['id'].'&sub_categories='.$sub_cat_rows['id'].'">'.$sub_cat_rows['sub_categories'].'</a>
                                                    </li>';
                                                    }?>
                                                    
                                                   
                                                </ul>
                                               <?php } ?>
                                            </div>
                                        </div>
                                    </li>
                                    
                                     <?php } ?>
                                    
                                    
                                    
                                </ul>
                            </div>
                        </div>

                        <div class="header-nav-middle">
                            <div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky">
                                <div class="offcanvas offcanvas-collapse order-xl-2" id="primaryMenu">
                                    <div class="offcanvas-header navbar-shadow">
                                        <h5>Menu</h5>
                                        <button class="btn-close lead" type="button"
                                            data-bs-dismiss="offcanvas"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        <ul class="navbar-nav">
                                            
                                            <?php
                                				foreach($cat_arr as $list){
                                			?>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="javascript:void(0) category.php?id=<?php echo $list['id']; ?>" data-bs-toggle="dropdown"
                                                    ><?php echo $list['categories']; ?></a>
                                                    <?php
                                        			  $cat_id=$list['id'];
                                        			//  echo "select * from sub_categories where status='1' and categories='$cat_id'"; (categories_id='$cat_id')
                                        			  $sub_cat_res=mysqli_query($con,"select * from sub_categories where status='1' and categories_id='$cat_id'");
                                        			  if(mysqli_num_rows($sub_cat_res)>0){
                                        			  ?>
                                                <ul class="dropdown-menu">
                                                    <?php while($sub_cat_rows=mysqli_fetch_assoc($sub_cat_res)){
                                                    echo '<li>
                                                        <a class="dropdown-item" href="category.php?id='.$list['id'].'&sub_categories='.$sub_cat_rows['id'].'">'.$sub_cat_rows['sub_categories'].'</a>
                                                    </li>';
                                                    }?>
                                                   
                                                </ul>
                                              <?php } ?>  
                                            </li>
                                            <?php } ?>
                                            

                                            

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->

    <!-- mobile fix menu start -->
    <div class="mobile-menu d-md-none d-block mobile-cart">
        <ul>
            <li class="active">
                <a href="index.php">
                    <i class="iconly-Home icli"></i>
                    <span>Home</span>
                </a>
            </li>

            <li class="mobile-category">
                <a href="javascript:void(0)">
                    <i class="iconly-Category icli js-link"></i>
                    <span>Category</span>
                </a>
            </li>

            <li>
                <a href="search.php" class="search-box">
                    <i class="iconly-Search icli"></i>
                    <span>Search</span>
                </a>
            </li>

            <li>
                <a href="wishlist.php" class="notifi-wishlist">
                    <i class="iconly-Heart icli"></i>
                    <span>My Wish</span>
                </a>
            </li>

            <li>
                <a href="cart.php">
                    <i class="iconly-Bag-2 icli fly-cate"></i>
                    <span>Cart</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- mobile fix menu end -->