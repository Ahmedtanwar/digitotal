<?php
$reqAuth = true;
$module = 'create_order';
require_once "../../include/config.php";
require_once("controller.php");

if($sessUserId <= 0){
	redirectPage(SITE_URL."login");
}

$token = (isset($_GET['token']) AND $_GET['token'] != "") ? $_GET['token'] : '';

$scripts = array(array("jquery.validate.min.js",SITE_JS));

$tab_title = "Create Order";

if(isset($_POST['action']) AND $_POST['action']=="submitOrderForm") 
{
	extract($_POST);
	
	$insert_array = array(
		"customer_name"    => $customer_name,
	    "customer_phone"   => $customer_phone,
	    "customer_email"   => $customer_email,
	    "customer_address" => $customer_address,
	    "customer_pincode" => $customer_pincode,
	    "customer_city"    => $customer_city,
	    "customer_state"   => $customer_state,
	    "product_name"     => $product_name,
	    "product_price"    => $product_price,
	    "product_qty"      => $product_qty,
	    "product_sku"      => $product_sku,
	    "product_category_id" => $product_category_id,
	    "payment_method"      => $payment_method,
	    "pickup_address_id"   => $pickup_address_id,
	    "ship_pack_weight"    => $ship_pack_weight,
	    "volumetric_cm_1"     => $volumetric_cm_1,
	    "volumetric_cm_2"     => $volumetric_cm_2,
	    "volumetric_cm_3"     => $volumetric_cm_3,
	    "courier_partner"     => $courier_partner,
	    "pickup_date"         => $pickup_date,
	    "created"             => created(),
	);

	$last_emp_code = $db->pdoQuery("SELECT order_id FROM tbl_order WHERE 1=1 ORDER BY id DESC LIMIT 1 ")->result();
  	
  	$last_id = $db->insert("tbl_order",$insert_array)->getLastInsertId();

	$order_id = $last_emp_code['order_id'];
	$new_order_id = str_pad($order_id + 1, 5, 0, STR_PAD_LEFT);
		
	$db->update("tbl_order",array("order_id" => $new_order_id),array("id"=>$last_id));
			
	$msgType = $_SESSION["msgType"] = disMessage(array('type'=>'suc','var'=> "Order created successfully."));
	
	redirectPage(SITE_URL."manage_order");		

}
if(isset($_POST['upload'])) 
{
	$filename = $_FILES["file"]["tmp_name"];

	if ($_FILES["file"]["size"] > 0) 
	{
		$file = fopen($filename, "r");

		while (($column  = fgetcsv($file, 10000, ",")) !== FALSE) 
	    {   
	        $customer_name = "";
	        if (isset($column[0])) {
	            $customer_name = $column[0];
	        }
	        $customer_phone = "";
	        if (isset($column[1])) {
	            $customer_phone = $column[1];
	        }
	        $customer_email = "";
	        if (isset($column[2])) {
	            $customer_email = $column[2];
	        }
	        $customer_address = "";
	        if (isset($column[3])) {
	            $customer_address = $column[3];
	        }
	        $customer_pincode = "";
	        if (isset($column[4])) {
	            $customer_pincode = $column[4];
	        } 
	        $customer_city = "";
	        if (isset($column[5])) {
	            $customer_city = $column[5];
	        }
	        $customer_state = "";
	        if (isset($column[6])) {
	            $customer_state = $column[6];
	        }
	        $product_name = "";
	        if (isset($column[7])) {
	            $product_name = $column[7];
	        }
	        $product_price = "";
	        if (isset($column[8])) {
	            $product_price = $column[8];
	        }
	        $product_qty = "";
	        if (isset($column[9])) {
	            $product_qty = $column[9];
	        }
	        $product_sku = "";
	        if (isset($column[10])) {
	            $product_sku = $column[10];
	        } 
	        $product_category_id = "";
	        if (isset($column[11])) {
	            $product_category_id = $column[11];
	        }
	        $payment_method = "";
	        if (isset($column[12])) {
	            $payment_method = $column[12];
	        }
	        $pickup_address_id = "";
	        if (isset($column[13])) {
	            $pickup_address_id = $column[13];
	        }
	        $ship_pack_weight = "";
	        if (isset($column[14])) {
	            $ship_pack_weight = $column[14];
	        } 
	        $volumetric_cm_1 = "";
	        if (isset($column[15])) {
	            $volumetric_cm_1 = $column[15];
	        }
	        $volumetric_cm_2 = "";
	        if (isset($column[16])) {
	            $volumetric_cm_2 = $column[16];
	        } 
	        $volumetric_cm_3 = "";
	        if (isset($column[17])) {
	            $volumetric_cm_3 = $column[17];
	        }
	        $courier_partner = "";
	        if (isset($column[18])) {
	            $courier_partner = $column[18];
	        } 
	        $pickup_date = "";
	        if (isset($column[19])) {
	            $pickup_date = $column[19];
	        }
	        
	        $insert_array = array(
		       "customer_name"    => $customer_name,
			    "customer_phone"   => $customer_phone,
			    "customer_email"   => $customer_email,
			    "customer_address" => $customer_address,
			    "customer_pincode" => $customer_pincode,
			    "customer_city"    => $customer_city,
			    "customer_state"   => $customer_state,
			    "product_name"     => $product_name,
			    "product_price"    => $product_price,
			    "product_qty"      => $product_qty,
			    "product_sku"      => $product_sku,
			    "product_category_id" => $product_category_id,
			    "payment_method"      => $payment_method,
			    "pickup_address_id"   => $pickup_address_id,
			    "ship_pack_weight"    => $ship_pack_weight,
			    "volumetric_cm_1"     => $volumetric_cm_1,
			    "volumetric_cm_2"     => $volumetric_cm_2,
			    "volumetric_cm_3"     => $volumetric_cm_3,
			    "courier_partner"     => $courier_partner,
			    "pickup_date"         => $pickup_date,
		        "created"             => created(),
		    ); 

		    $last_emp_code = $db->pdoQuery("SELECT order_id FROM tbl_order WHERE 1=1 ORDER BY id DESC LIMIT 1 ")->result();
		  	
		  	$last_id = $db->insert("tbl_order",$insert_array)->getLastInsertId();
		  	
			$order_id = $last_emp_code['order_id'];
			$new_order_id = str_pad($order_id + 1, 5, 0, STR_PAD_LEFT);
				
			$db->update("tbl_order",array("order_id" => $new_order_id),array("id"=>$last_id)); 
	    }
	    $msgType = $_SESSION["msgType"] = disMessage(array('type'=>'suc','var'=> "Order created successfully."));
			
		redirectPage(SITE_URL."manage_order");
	}
}  
else 
{
	$object = new Controller($module,$token);
	$pageContent = $object->getHTML();

	require_once DIR_TMPL . "replace.php";
}
?>