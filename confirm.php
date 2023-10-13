<?php 
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', TRUE);

	include('includes/db_config.php');				
	session_start();

	$id = $_SESSION["agent"]->id;
	$name = $_SESSION["agent"]->name;
	$phone = $_SESSION["agent"]->phone;
	$email = $_SESSION["agent"]->email;
	
	if(isset($_POST['confirm'])){
		
		
		$collection_day = $_POST['collection_day'];
		$packs = $_POST['packs'];
		$address = $_POST['address'];
		$contact = $_POST['contact'];
		$status = 'pending';
		$res_id = '2';
		$comment = 'Collect it '.$collection_day.' ,Kindly call :'.$contact;
		$location = $address;
		$order_id = 'PACK-RET-'.rand(1111,9999);
				
     
            // Insert into Database
            
            //$conn = mysqli_connect($server_name, $user_name, $password , $database);
						
			$sql = "INSERT INTO `orders` (`unique_order_id`, `orderstatus_id`, `user_id`, `coupon_name`, `location`, `address`, `tax`, `restaurant_charge`, `delivery_charge`, `actual_delivery_charge`, `total`, `created_at`, `updated_at`, `payment_mode`, `order_comment`, `restaurant_id`, `transaction_id`, `delivery_type`, `payable`, `wallet_amount`, `tip_amount`, `tax_amount`, `coupon_amount`, `sub_total`, `cash_change_amount`, `is_scheduled`, `schedule_date`, `schedule_slot`, `distance`, `delivery_pin`, `zone_id`) VALUES ( '$order_id', '1', '$id', '', '$location', '$address', '', '', '0', '0', '0', '', '', 'COD', '$comment', '$res_id', '', '1', '0.00', '', '', '', '', '', '', '0', '', '', '', '123456', '1')";
			$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

			$sql1 = "INSERT INTO `orderitems` (`order_id`, `item_id`, `name`, `quantity`, `price`) VALUES ('999', '26', 'Smart Pack Collection', '$packs', '0.00')";
			$result1 = mysqli_query($conn,$sql1) or die(mysqli_error($conn));
			
			$sql2 = "INSERT INTO `collections` (`user_id`, `day`, `packs`, `address`, `contact`, `status`) VALUES ('$id', '$collection_day','$packs' ,'$address', '$contact', '1')";
			$result = mysqli_query($conn,$sql2) or die(mysqli_error($conn));

		if($result){
			
            echo $statusMsg = 'Ticket created successfully.';
            
            header("Location: finish.php");
            exit();
			
        }else{
             echo $statusMsg = 'Some problem occurred, please try again.'.mysqli_error($conn);
			 $qstring = '?status=err';
             header("Location: finish.php?orderno=".$statusMsg);
             exit();
        }
		
	}	

?>
