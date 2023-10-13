<?php
include('includes/db_config.php');
session_start();

$id = $_SESSION["agent"]->id;
$fullname = $_SESSION["agent"]->fullname;
$contact = $_SESSION["agent"]->contact;
$email = $_SESSION["agent"]->email;
$type = $_SESSION["agent"]->type;
$date = date('D d M Y, h:i:s a T');

$today = date('y-m-d');
	
/* $sql1 ="SELECT COUNT(id) AS packs from orders WHERE user_id = '$id' AND orderstatus_id = '5' ";
$q = $conn->query($sql1);
$res = $q->fetch_assoc();
$packs=$res['packs']; */


?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Home</title>
  <link rel="stylesheet" href="public/front/assets/css/styleae52ae52.css?v=5">
  <link rel="stylesheet" href="public/front/assets/css/custom.css">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />

  <link rel="apple-touch-icon" sizes="180x180" href="public/front/assets/img/apple-touch-icon.png">
  <link rel="icon" type="image/png" href="public/front/assets/img/favicon.png" sizes="32x32">
  <link rel="shortcut icon" href="public/front/assets/img/favicon.png">
  
</head>
<style>
	.pill {
		height: 30px;
		width: fit-content;
		border-radius: 4px;
		color: #ffff;
		padding: 3px;
		text-align: center;
	}
</style>
<body class="only-mobile">
  <!-- class="only-mobile" --><!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="dashboard.php" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">
        <h2 class="mt-1 text-white">Add Beneficiary</h2>
    </div>
    <div class="right">
        
        <a href="#!" class="headerButton">
            <img src="public/front/assets/img/logo.png" alt="image" class="imaged w32">
            <!-- <span class="badge badge-danger">6</span> -->
        </a>
    </div>
</div>
<!-- * App Header -->
<!-- App Sidebar -->

<!-- * App Sidebar -->
<div id="appCapsule">
		<div class="section mt-2 text-center">
            <img src="public/front/assets/img/logo.png" class="imaged w-50" style="width:50px !important;height: 50px;">
        </div>
        <div class="section mb-5 p-2">
                        <span id="msg"></span>
            <form action="confirm.php" id="userform" method="POST">
                <div class="card">
                    <div class="card-body">
                       
					   <div class="pill" style="background: #007bff;">Packs to collect : <?php echo $packs; ?></div>
					   
					   
                       <br />
                        <input type="hidden" name="action" value="play" />
                        <input type="hidden" name="packs" value="<?php //echo $packs; ?>" />
						<div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="name">When can we collect it?</label>
								<select class="form-control" id="collection_day" name="collection_day">
									<option value="today">Today</option>
									<option value="tomorrow">Tomorrow</option>
									<option value="week">Within the week</option>
								</select>
                                
                            </div>
                        </div>
						
						<div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="name">Select Address</label>
								<select class="form-control" id="address" name="address">
								<?php
								//include('includes/db_config.php');	
								$result = $conn->query("SELECT * FROM addresses WHERE user_id = '$id'");
								
								while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
								$loc = '{"lat":"'.$rs['latitude'].'","lng":"'.$rs['longitude'].'","address":"","house":"","tag":""}';	
								
								$locOld = '{"lat":"'.$rs['latitude'].'","lng":"'.$rs['longitude'].'","address":"'.$rs['address'].'","house":"'.$rs['house'].'","tag":"'.$rs['tag'].'"}';
									
									
								 echo' <option value='.$loc.'>'.$rs['address'].' - '.$rs['tag'].'</option>';   
								}

								$conn->close();
								 
								 
								?>
								</select>
								
                                
                            </div>
                        </div>
						
						<div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="mobile">Alternative Contact</label>
                                <input type="text" class="form-control" id="phone" name="contact" value="<?php echo $phone; ?>">
                                <small class="text-danger" id="mobe"></small>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
						
        
                    </div>
                </div>



                <div class="form-button-group transparent">
                    <button type="submit" class="btn btn-primary btn-block btn-lg" name="confirm">Confirm</button>
                </div>

            </form>
        </div>
    

</div>  
<!-- Bootstrap-->
<script src="public/front/assets/js/lib/jquery-3.4.1.min.js"></script>
<script src="public/front/assets/js/lib/bootstrap.min.js"></script>
<!-- Ionicons -->
<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
<!-- Owl Carousel -->

<!-- Base Js File -->

</body>

</html>