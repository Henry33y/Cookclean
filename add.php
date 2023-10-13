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

$name = '';
$gender = '';
$age = '';
$contact = '';
$alt_contact = '';
$model = '';
$community = '';
$town = '';
$gps = '';
$idcard = '';
$photo = '';

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
	
	.idcard {
		display:none;
	}
	
	.photo {
		display:none;
	}
	
	.gps-btn {
		width: 50px;
		height: 50px;
		border: grey;
		border-radius: 10px;
		font-size: 25px;
	}
</style>
<style>
	.holder {
		height: 300px;
		width: 300px;
		border: 2px solid black;
	}
	.photo-img {
		max-width: 300px;
		max-height: 300px;
		min-width: 300px;
		min-height: 300px;
	}
	input[type="file"] {
		margin-top: 5px;
	}
	
	  .photo-div{
        text-align:center;
        padding:3%;
        border:thin solid black;
      }

      input[type="file"]{
        display: none;
      }
      label{
        cursor:pointer;
      }
      #imageName{
        color:green;
      }
	
</style>
<body class="only-mobile">
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
		$("#gps").val(lat+','+long);
		
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
			<ion-icon name="person-add-outline" style="font-size: 55px;"></ion-icon>
			<h4>Enter beneficiary details in the form below </h4>
			
        </div>
				
		<?php echo (isset($_GET["statusMsg"])) ? '<div class="alert alert-info alert-rounded mx-4 my-2"> <i class="ti-alert"></i>'.$_GET['statusMsg'].'<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
		</div>' : '' ?>
		
        <div class="section mb-5 p-2">
                        <span id="msg"></span>
            <form action="add_ben.php" method="POST" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-body">
                       <input type="hidden" name="agent_id" value="<?php echo $id; ?>" />					   
					   <div class="form-group basic">
                            <!--<div class="input-wrapper" style="    background: #007bff69;padding: 8px;   border-radius: 5px;">-->
							<div class="input-wrapper">
                                <label class="label" for="name">Town</label>
								<select class="form-control" id="model" name="town">
								<option value="D">Select town</option>
								<?php
								//include('includes/db_config.php');	
								$result = $conn->query("SELECT * FROM towns
								");
								
								while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
								
								echo' <option value='.$rs['town_id'].'>'.$rs['town_name'].' - '.$rs['town_region'].' Region</option>';   
								}

								 
								?>
								</select>
								
                                
                            </div>
                        </div>
						<div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="mobile">Community</label>
                                <input type="text" class="form-control" id="community" name="community" value="<?php echo $community; ?>">
                                <small class="text-danger" id="community"></small>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
						<div class="form-group basic" style="display:flex;">
                            <div class="input-wrapper" style="width:80%;">
                                <label class="label" for="mobile">GPS  
								</label>
								<input type="text" class="form-control" id="gps" name="gps" value="<?php echo $gps; ?>">
                            </div>
							<div onclick="return getlocation()" style="width:20%;">		
								<button type="button" class="gps-btn">
									<ion-icon name="location-outline"></ion-icon>
								</button>			
                            </div>
							
                        </div>
						<small><span id="location"></span></small>
                        
                    </div>
					</div>
					<div class="card mt-2">
					<div class="card-body">
						<div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="mobile">Full name</label>
                                <input type="text" class="form-control" id="phone" name="name" value="<?php echo $name; ?>">
                                <small class="text-danger" id="name"></small>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
						
						<div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="name">Gender</label>
								<select class="form-control" id="gender" name="gender">
									<option value="D">Select gender</option>
									<option value="M">Male</option>
									<option value="F">Female</option>
								</select>
                                
                            </div>
                        </div>
						
						<div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="mobile">Age</label>
                                <input type="text" class="form-control" id="age" name="age" value="<?php echo $age; ?>">
                                <small class="text-danger" id="age"></small>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
						
						<div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="mobile">Contact</label>
                                <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $contact; ?>">
                                <small class="text-danger" id="age"></small>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
						
						<div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="mobile">Alternative Contact</label>
                                <input type="text" class="form-control" id="alt_contact" name="alt_contact" value="<?php echo $alt_contact; ?>">
                                <small class="text-danger" id="mobe"></small>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
						
						<div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="name">Preferred cookstove model</label>
								<select class="form-control" id="model" name="model">
								<option value="D">Select cookstove</option>
								<?php
								//include('includes/db_config.php');	
								$result1 = $conn->query("SELECT * FROM cookstoves");
								
								while($rs1 = $result1->fetch_array(MYSQLI_ASSOC)) {
									
								 echo' <option value='.$rs1['code'].'>'.$rs1['code'].'-'.$rs1['name'].' - '.$rs1['manufacturer'].'</option>';   
								}

								 
								 
								?>
								</select>
								
                                
                            </div>
                        </div>
						
						<div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="name">Installment method</label>
								<select class="form-control" id="installment" name="installment">
									<option value="">Select method</option>
									<option value="Weekly">Weekly</option>
									<option value="Monthly">Monthly</option>
								</select>
                                
                            </div>
                        </div>
						
						<div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="mobile"> </label>
                                								 
								<div class="photo-div">
									<label for="inputTag">
										Select Image <br/>
										<ion-icon name="camera-outline"></ion-icon>
										<img id="idcard" alt="your image" width="100%" height="" src="" class="idcard" />
										<input id="inputTag" name="idcard" type="file" onchange="document.getElementById('idcard').src = window.URL.createObjectURL(this.files[0]);document.getElementById('idcard').style.display = 'block';"/>
										<br/>
										<span id="imageName"></span>
									</label>
								</div>
								
								
                                
                            </div>
                        </div>
						
						<!--<div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="mobile">Photo </label>
                                <img id="photo" alt="photo" width="200" height="200" src="" class="photo" />

								<input type="file" name="photo" 
								onchange="document.getElementById('photo').src = window.URL.createObjectURL(this.files[0]);document.getElementById('photo').style.display = 'block';">
                                
                            </div>
                        </div>-->
						
        
                    </div>
                </div>



                <div class="form-button-group transparent">
                    <input type="submit" class="btn btn-primary btn-block btn-lg" name="submit" value="Confirm"></input>
                </div>
				
				
            </form>
        </div>
    

</div>  
<script>
	let input = document.getElementById("inputTag");
	let imageName = document.getElementById("imageName")

	input.addEventListener("change", ()=>{
		let inputImage = document.querySelector("input[type=file]").files[0];

		imageName.innerText = inputImage.name;
	})
</script>
<script>
function showPic() {
  var x = document.getElementById("idcard");
  x.src = window.URL.createObjectURL(this.files[0])
  x.style.display = "block";
  
}

</script>

<!-- Bootstrap-->
<script src="public/front/assets/js/lib/jquery-3.4.1.min.js"></script>
<script src="public/front/assets/js/lib/bootstrap.min.js"></script>
<!-- Ionicons -->
<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
<!-- Owl Carousel -->

<!-- Base Js File -->

</body>

</html>