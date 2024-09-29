<?php
function pr($arr){
	echo '<pre>';
	print_r($arr);
}

function prx($arr){
	echo '<pre>';
	print_r($arr);
	die();
}

function get_safe_value($con,$str){
	if($str!=''){
		$str=trim($str);
		return mysqli_real_escape_string($con,$str);
	}
} 
function get_product($con,$limit='',$cat_id='',$product_id='',$is_beverage_drinks='',$is_dairy_products='',$is_fashion_beauty='',$is_fruits_vegitables='',$is_health_care_products='',$is_home_essentials='',$is_indian_grocery='',$is_tiffin_service='',$is_pet_products='',$search_str='',$sort_order='',$sub_categories=''){
	$sql="select product.*,categories.categories from product,categories where product.status=1 ";
	if($cat_id!=''){
		$sql.=" and product.categories_id=$cat_id ";
	}
	
	if($product_id!=''){
		$sql.=" and product.id=$product_id ";
	}
	
	if($sub_categories!=''){
		$sql.=" and product.sub_categories_id=$sub_categories ";
	}
	
	if($is_beverage_drinks!=''){
		$sql.=" and product.beverage_drinks=1 ";
	}
	
	if($is_dairy_products!=''){
		$sql.=" and product.dairy_products=1 ";
	}
	
	if($is_fashion_beauty!=''){
		$sql.=" and product.fashion_beauty=1 ";
	}
	
	if($is_fruits_vegitables!=''){
		$sql.=" and product.fruits_vegitables=1 ";
	}
	
	if($is_health_care_products!=''){
		$sql.=" and product.health_care_products=1 ";
	}
	
	if($is_home_essentials!=''){
		$sql.=" and product.home_essentials=1 ";
	}
	
	
	if($is_indian_grocery!=''){
		$sql.=" and product.indian_grocery=1 ";
	}
	
	if($is_tiffin_service!=''){
		$sql.=" and product.tiffin_service=1 ";
	}
	
	if($is_pet_products!=''){
		$sql.=" and product.pet_products=1 ";
	}
	
	$sql.=" and product.categories_id=categories.id ";
	
	if($search_str!=''){
		$sql.=" and (product.name like '%$search_str%' or product.description like '%$search_str%') ";
	}
	
	if($sort_order!=''){
		$sql.=$sort_order;
	}else{
		$sql.=" order by product.id desc ";
	}
	
	
//	$sql.=" order by product.id desc";
	
	if($limit!=''){
		$sql.=" limit $limit";
	}
	
	$res=mysqli_query($con,$sql);
	$data=array();
	while($row=mysqli_fetch_assoc($res)){
		$data[]=$row;
	}
	return $data;
}
function productSoldQtyByProductId($con,$pid){
	$sql="select sum(order_detail.qty) as qty from order_detail,`order` where `order`.id=order_detail.order_id and order_detail.product_id=$pid and `order`.order_status!=4";
	$res=mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($res);
	return $row['qty'];
}


function wishlist_add($con,$uid,$pid){
	$added_on=date('Y-m-d h:i:s');
	mysqli_query($con,"insert into wishlist(user_id,product_id,added_on) values('$uid','$pid','$added_on')");
}

?>
