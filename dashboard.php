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
	
$sql1 ="SELECT COUNT(id) AS bene from beneficiaries";
$q = $conn->query($sql1);
$res = $q->fetch_assoc();
$bene=$res['bene'];

$sql2 ="SELECT COUNT(town_id) AS allTowns from towns";
$q = $conn->query($sql2);
$res = $q->fetch_assoc();
$towns=$res['allTowns'];

$sql3 ="SELECT COUNT(id) AS allCookstoves from cookstoves";
$q = $conn->query($sql3);
$res = $q->fetch_assoc();
$cookstoves=$res['allCookstoves'];

/* $sql4 ="SELECT COUNT(id) AS surveys from surveys";
$q = $conn->query($sql4);
$res = $q->fetch_assoc();
$surveys=$res['surveys']; */


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
  <script src="public/front/assets/js/lib/jquery-3.4.1.min.js"></script>
</head>
<style>
	.pill {
		height: 30px;
		width: 45px;
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
        <a href="#" class="headerButton" data-toggle="modal" data-target="#sidebarPanel">
            <ion-icon name="menu-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">
        <h2 class="mt-1 text-white">GHACCO</h2>
    </div>
    <div class="right">
        <a href="logout.php" class="headerButton">
            <ion-icon name="lock-closed-outline"></ion-icon>
        </a>
        <a href="#!" class="headerButton">
            <img src="public/front/assets/img/logo.png" alt="image" class="imaged w32">
            <!-- <span class="badge badge-danger">6</span> -->
        </a>
    </div>
</div>
<!-- * App Header -->
<div id="appCapsule">
    

	<!-- Info -->
	<!--<div class="section">
		<div class="row mt-2">
            <div class="col-12">
                <div class="stat-box">
					<div class="text-center">
					<h3><small>Welcome<small> <?php echo $fullname; ?></h3>
					</div>
                    <div class="title">
						
						<h4><ion-icon name="call"></ion-icon> <?php echo $contact; ?></h4>
						<h4><ion-icon name="mail"></ion-icon> <?php echo $email; ?></h4>
						<h4><ion-icon name="today-outline"></ion-icon> <?php echo $date; ?></h4>
						
						 
					</div> 
                    
                </div>
            </div>			
        </div>
    </div>-->
	<!-- * Info -->
    <!-- Stats -->
    <div class="section">
		<div class="text-center mt-2">
			<h3>Welcome <?php echo $fullname; ?></h3>
		</div>
        <div class="row mt-2">
            <div class="col-6">
                <div class="stat-box" onclick="window.location.href='#!'">
                    <div class="title">All Beneficiaries</div>
                    <div class="pill" style="background: #007bff;">
						<?php echo $bene > 0 ? $bene : '0'; ?>
					</div>
					
                </div>
            </div>
			<div class="col-6">
                <div class="stat-box" onclick="window.location.href='#!'">
                    <div class="title">All Towns</div>
                    <div class="pill" style="background: #007bff;"><?php echo $towns > 0 ? $towns : '0'; ?></div>
					
                </div>
            </div>
            <!--<div class="col-6 mt-2">
                <div class="stat-box" onclick="window.location.href='#!'">
                    <div class="title">Cookstoves</div>
                    <div class="pill" style="background: #007bff;">
					<?php echo $cookstoves > 0 ? $cookstoves : '0'; ?>
					</div>
					
                </div>
            </div>-->
			<!--<div class="col-6 mt-2">
                <div class="stat-box" onclick="window.location.href='#!'">
                    <div class="title">Surveys</div>
                    <div class="pill" style="background: #007bff;"><?php //echo $surveys > 0 ? $surveys : '0'; ?></div>
					
                </div>
            </div>-->
			<div class="text-center mt-2 w-100">
				<h3>Current location</h3>
				<p class="text-danger" id="gps"><small>loading..</small></p>
				<!--<p class="text-sm" id="location"></p>-->
			</div>
			
			
			
			<div class="form-button-group transparent" style="bottom: 70px !important;">
				<button type="submit" name="login-btn" class="btn btn-primary btn-lg btn-block" style="width:100%;" onclick="window.location.href = 'add.php';"> Add Beneficiary </button>
							   
			</div>
        </div>
        
    </div>
    <!-- * Stats -->


</div><script>
  ;
  (function($, window, document, undefined) {
    $('document').ready(function() {

      setInterval(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
          $(this).remove();
        });
      }, 3000);

    });
  })(jQuery, window, document);
</script>

    <!-- App Bottom Menu -->
  <div class="appBottomMenu" style="">
    <a href="towns.php" class="item">
      <div class="col">
        <ion-icon name="map-outline"></ion-icon>
        <strong>Towns</strong>
      </div>
    </a>
    <a href="#!" onclick="return getlocation()" class="item">
      <div class="col">
        <div class="action-button large">
          <ion-icon name="locate-outline"></ion-icon>
        </div>
      </div>
    </a>
        <a href="all.php" class="item">
      <div class="col">
        <ion-icon name="people-outline"></ion-icon>
        <strong>Beneficiaries</strong>
      </div>
    </a>
  </div>
  <!-- * App Bottom Menu -->
<script type="text/javascript">
	function getlocation() {
		if (navigator.geolocation) { 
			/* if(document.getElementById('location').innerHTML == '') {
				navigator.geolocation.getCurrentPosition(visitorLocation);
			} */ 
			navigator.geolocation.getCurrentPosition(visitorLocation);
			
		} else { 
			$('#location').html('This browser does not support Geolocation Service.');
		}
	}
	function visitorLocation(position) {
		var lat = position.coords.latitude;
		var long = position.coords.longitude;
		$("#gps").html(lat+','+long);
		
		$.ajax({
			type:'POST',
			url:'get_location.php',
			data:'latitude='+lat+'&longitude='+long,
			success:function(address){
				if(address){
				   $("#location").html(address);
				}else{
					$("#location").html('Not Available');
				}
			}
		});
	}
</script>
<!-- Bootstrap-->
<script src="public/front/assets/js/lib/popper.min.js"></script>
<script src="public/front/assets/js/lib/bootstrap.min.js"></script>
<!-- Ionicons -->
<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
<!-- Owl Carousel -->
<script src="public/front/assets/js/plugins/owl-carousel/owl.carousel.min.js"></script>
<!-- Base Js File -->

</body>

</html>