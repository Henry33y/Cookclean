<?php

include('../includes/db_config.php');	


$Item=$_POST["Item"];

//mysqli_query($conn, "INSERT INTO Perfume(Item_Name)  VALUES('$Item_Name')");


        /*$game_day = $_POST['game_day'];
		$game = $_POST['game'];
		$gametype = $_POST['game_type'];
		$numbers = $_POST['numbers'];
		$stake = $_POST['stake'];
		$payment_type = $_POST['payment_type']; 
		$tel = $_POST['tel'];
		$contact = '233'.ltrim($tel,"0");
		//$orderno = rand(100000,999999);
		$status = 'pending';
		
		
		
		   if($gametype=='2sure'){
               $totalpayable=1*$stake;
           }
           else if($gametype=='3direct'){
               $totalpayable=1*$stake;
           }
           else if($gametype=='perm2'){
                $pattern = '/[-\s:,*.)]/';
                $numbers = $numbers;
                $tot_numbers = count( preg_split( $pattern, $numbers ), 1 );
                
                if($tot_numbers == 3){
                   $totalpayable=3*$stake; 
                }
                if($tot_numbers == 4){
                   $totalpayable=6*$stake; 
                }
                if($tot_numbers == 5){
                   $totalpayable=10*$stake; 
                }
                if($tot_numbers == 6){
                   $totalpayable=15*$stake; 
                }
                if($tot_numbers == 7){
                   $totalpayable=21*$stake; 
                }
                if($tot_numbers == 8){
                   $totalpayable=28*$stake; 
                }
                if($tot_numbers == 9){
                   $totalpayable=36*$stake; 
                }
                if($tot_numbers == 10){
                   $totalpayable=45*$stake; 
                }
           }*/
            
            // Collect game details
            
            
            /*$game_day = $_POST['game_day'];
            $game = $_POST['game'];
            $game_type = $_POST['game_type'];
            $numbers = $_POST['numbers'];
            $stake_amount = $_POST['stake'];
            $pay_amount = $totalpayable*0.7;
            $payment_mode = $_POST['payment_type'];
            $tel = $_POST['tel'];
            $contact;
            $agent = $id;
            $orderid = rand(100000,999999);
            $status = 'pending';*/


            $sql = "INSERT INTO `plays` (`numbers`) VALUES ('$Item')";
            
            $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
?>