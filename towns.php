<?php
include('includes/db_config.php');
session_start();

/* $id = $_SESSION["agent"]->id;
$fullname = $_SESSION["agent"]->fullname;
$username = $_SESSION["agent"]->username;
$contact = $_SESSION["agent"]->contact;
$email = $_SESSION["agent"]->email;
$machine = $_SESSION["agent"]->machine_id;
$password = $_SESSION["agent"]->password; */
$date = date('D d M Y, h:i:s a T');

$today = date('y-m-d');
	

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
	.menu {
		border: 1px solid #9e9e9e33;
		padding: 5px;
	}
	
	.label {
		margin-bottom: 1px;
	}
	
	.badge-info, a.badge-info {
		background: #767676 !important;
	}

	p {
		color: black;
	}
	
	#myInput {
	  background-image: url('public/front/assets/img/searchicon.png');
	  background-position: 10px 12px;
	  background-repeat: no-repeat;
	  width: 100%;
	  font-size: 16px;
	  padding: 12px 20px 12px 40px;
	  border: 1px solid #ddd;
	  margin-bottom: 12px;
	}
</style>
<body class="only-mobile">
  <!-- class="only-mobile" --><!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="dashboard.php" class="headerButton">
            <ion-icon name="home"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">
        <h2 class="mt-1 text-white">All Towns</h2>
    </div>
    <div class="right">
        
        <a href="town.php" class="headerButton">
            <ion-icon name="add-circle-outline"></ion-icon>
        </a>
    </div>
</div>
<!-- * App Header -->
<div id="appCapsule">
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by name.." title="Search by name">
	
	
	<?php echo (isset($_GET["statusMsg"])) ? '<div class="alert alert-info alert-rounded mx-4 my-2"> <i class="ti-alert"></i>'.$_GET['statusMsg'].'<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
		</div>' : '' ?>
		
	<!-- Info -->
	<div class="section">
		<div id="myUL" class="row mt-2">
            
			<?php 
					
				$sql = $conn->query("SELECT * FROM towns ORDER BY towns.timestamp DESC;");
								
				while($rs = $sql->fetch_array(MYSQLI_ASSOC)) {
					$id = $rs['town_id'];
					
					$town_location = $rs['town_location'];
					$town_name = $rs['town_name'];
					$town_region = $rs['town_region'];

			
				?>
					
					
					
				<div class="thisitem col-lg-12 col-md-12 col-xs-12 col-sm-12 mb-3">
				 
				  <div class="stat-box mb-2" style="padding:1px;">
				   <div class="" style="padding: 5px;position:absolute;"></div>
					<div class="card-body" style="padding:1px;">
					 <div class="" style="display:flex;">
						 
						 <div class="px-2 py-1" style="width:100%;">
							 <p class="search">Name : <span class="badge badge-info badge-custom badge-pill pull-right"><?php echo $town_name; ?></span></p>
							 <p class="search">Region : <span class="badge badge-info badge-custom badge-pill pull-right"><?php echo $town_region; ?></span></p>
						 </div>	
					 </div>	
				    </div>
					<div class="text-center" style="display:flex;    border-top: 1px solid #00000029;">
						<div class="text-center" onclick="<?php echo ($town_location != "" ) ? "window.location.href='http://maps.google.com/maps?q=".$town_location."'" : "alert('Location data not available!')" ?>" class="menu" style="width:100%;">
							<ion-icon name="navigate-outline"></ion-icon>
							<label class="label" for="mobile">Navigate  
							</label>
							
							<?php echo ($town_location != '' ) ? '<ion-icon name="checkmark-circle-outline" class="text-success"></ion-icon>' :'<ion-icon name="alert-circle-outline" class="text-danger"></ion-icon>' ?>
							
						</div>
						
							
                    </div>
				  </div>
				</div>					
			 
			<?php }

			$conn->close();

			?>
			
        </div>
    </div>
	<!-- * Info -->
    


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
<script>
function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByClassName("thisitem");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("span")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
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