<?php
session_start();
$con = mysqli_connect('localhost','u954921667_singh','Viet@789','u954921667_singh');

// define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/shivansh/');
// define('SITE_PATH','http://localhost/shivansh/');
/*
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/aligarments.co.in/');
define('SITE_PATH','http://aligarments.co.in/');

define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'admin/media/product/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'admin/media/product/');
 */
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/singhsaigon.com/');
define('SITE_PATH','https://singhsaigon.com/');

define('PROFILE_IMAGE_SERVER_PATH',SERVER_PATH.'singh/media/product/');
define('PROFILE_IMAGE_SITE_PATH',SITE_PATH.'singh/media/product/');

define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'singh/media/product/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'singh/media/product/');


define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'singh/media/gallery/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'singh/media/gallery/');

define('SLIDER_IMAGE_SERVER_PATH',SERVER_PATH.'singh/media/slider/');
define('SLIDER_IMAGE_SITE_PATH',SITE_PATH.'singh/media/slider/');

define('GALLERY_IMAGE_SERVER_PATH',SERVER_PATH.'singh/media/gallery/');
define('GALLERY_IMAGE_SITE_PATH',SITE_PATH.'singh/media/gallery/');



if(!$con)
{
	die("Connection failed: " . mysqli_connect_error());
}
?>