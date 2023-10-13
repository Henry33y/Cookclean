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
							<div class="input-wrapper">
                                <label class="label" for="name">Name of School</label>
								<input type="text" class="form-control" name="school_name" id="school_name">
                            </div>
                        </div>
						<div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="school_type">Type of School</label>
                                <select class="form-control" id="school_type" name="school_type">
									<option value="default">Select School Type</option>
									<option value="day_and_boarding">SHS Day and Boarding</option>
									<option value="boarding_only">Only Boarding</option>
								</select>
                            </div>
                        </div>
						
						<small><span id="location"></span></small>
						<div class="form-group basic">
							<div class="input-wrapper">
								<label class="label" for="no_of_students">No. of Students</label>
								<input type="number" class="form-control" name="no_of_students" id="no_of_students">
							</div>
						</div>
						
						<div class="form-group basic">
							<div class="input-wrapper">
								<label class="label" for="school_days_in_year">How many school days in a year?</label>
								<input type="number" class="form-control" name="school_days_in_year" id="school_days_in_year">
							</div>
						</div>
						
						<div class="form-group basic">
							<div class="input-wrapper">
								<label class="label" for="shs_gender">SHS Gender</label>
								<select class="form-control" id="shs_gender" name="shs_gender">
									<option value="default">Select SHS</option>
									<option value="boys_only">Boys Only</option>
									<option value="girls_only">Girls Only</option>
								</select>
							</div>
						</div>
						
						<div class="form-group basic">
							<div class="input-wrapper">
								<label class="label" for="location">Location Address</label>
								<input type="text" class="form-control" id="location" name="location">
							</div>
						</div>
						<div class="form-group basic" style="display:flex;">
                            <div class="input-wrapper" style="width:80%;">
                                <label class="label" for="gps_address">GPS Address</label>
								<input type="text" class="form-control" id="gps_address" name="gps_address" value="<?php echo $gps; ?>">
                            </div>
							<div onclick="return getlocation()" style="width:20%;">		
								<button type="button" class="gps-btn">
									<ion-icon name="location-outline"></ion-icon>
								</button>			
                            </div>
							
                        </div>
						
						<div class="form-group basic">
							<div class="input-wrapper">
								<label class="label" for="school_head">Name of Head of School</label>
								<input type="text" class="form-control" id="school_head" name="school_head" value="<?php echo $alt_contact; ?>">
								<small class="text-danger" id="head"></small>
								<i class="clear-input">
									<ion-icon name="close-circle"></ion-icon>
								</i>
							</div>
						</div>
						
						<div class="form-group basic">
							<div class="input-wrapper">
								<label class="label" for="tel_of_school_head">Telephone number of Head of School</label>
								<input type="tel" class="form-control" name="tel_of_school_head" id="tel_of_school_head">
							</div>
						</div>
						
						<div class="form-group basic">
							<div class="input-wrapper">
								<label class="label" for="name_of_contact_person">Name of Contact Person for the Project</label>
								<input type="text" class="form-control" name="name_of_contact_person" id="name_of_contact_person">
							</div>
						</div>
						<div class="form-group basic">
							<div class="input-wrapper">
								<label class="label" for="tel_of_person_assigned">Telephone number of person assigned to the project</label>
								<input type="tel" class="form-control" name="tel_of_person_assigned" id="tel_of_person_assigned">
							</div>
						</div>
						<div class="form-group basic">
							<div class="input-wrapper">
								<label class="label" for="email_of_school">Email address of school and contact person</label>
								<input type="email" class="form-control" name="email_of_school" id="email_of_school">
							</div>
						</div>
						<div class="form-group basic">
							<div class="input-wrapper">
								<label class="label" for="fuel_type">Type of fuel used by the school in cooking for students</label>
								<select name="fuel_type" id="fuel_type" class="form-control">
									<option value="default">Select Fuel</option>
									<option value="firewood">Firewood</option>
									<option value="charcoal">Charcoal</option>
									<option value="lpg">LPG</option>
									<option value="others">Others(Specify)</option>
									<option value="two_others">Two of the above(Specify)</option>
									<option value="all">All of the above</option>
								</select>
							</div>
							<div class="input-wrapper specify_fuel">
								<label for="other_fuel_type" class="label d-none" id="other_fuel_label">Please specify fuel type</label>
								<input type="text" name="other_fuel_type" id="other_fuel_type" class="form-control d-none">
								<div class="d-none" id="fuel_checkboxes">
									<input type="checkbox"> Firewood<br>
									<input type="checkbox"> Charcoal<br>
									<input type="checkbox"> LPG<br>
								</div>
							</div>
						</div>
						<script defer>
							const selectFuel = document.getElementById('fuel_type')
							const otherFuelLabel = document.getElementById('other_fuel_label')
							const otherFuelType = document.getElementById('other_fuel_type')
							const fuelCheckboxes = document.getElementById('fuel_checkboxes')
							selectFuel.addEventListener('change',()=>{
								const selectedOption = selectFuel.options[selectFuel.selectedIndex]
								if(selectedOption.value === "others"){
									if(otherFuelLabel.classList.contains('d-none')){
										otherFuelLabel.classList.remove('d-none')
									}
									fuelCheckboxes.classList.add('d-none')
									otherFuelType.classList.remove('d-none')
								}
								else if(selectedOption.value === "two_others"){
									if(!otherFuelType.classList.contains('d-none')){
										otherFuelType.classList.add('d-none')
									}
									if(fuelCheckboxes.classList.contains('d-none')){
										fuelCheckboxes.classList.remove('d-none')
									}
								}
								else{
									otherFuelLabel.classList.add('d-none')
									otherFuelType.classList.add('d-none')
									fuelCheckboxes.classList.add('d-none')
								}
							})
						</script>
						<div class="form-group basic">
							<div class="input-wrapper">
								<label class="label" for="stove_type">Type of stoves used in the school kitchen</label>
								<select name="stove_type" id="stove_type" class="form-control">
									<option value="default">Select Stove</option>
									<option value="tire_rim_stove">Tire Rim Stove Normal</option>
									<option value="charcoal">Charcoal</option>
									<option value="three_stone_firewood">Three Stone Firewood Stove</option>
									<option value="other_stove">Other firewood stove</option>
								</select>
							</div>
						</div>
						<div class="form-group basic">
							<div class="input-wrapper">
								<label class="label" for="fuel_cost_per_month">Cost of Fuel used per month</label>
								<div class="row align-items-center">
									<label class="col-4 pt-2">a) LPG</label><input class="form-control col-8" type="text" name="lpg">
								</div>
								<div class="row align-items-center">
									<label class="col-4 pt-2">b) Firewood</label><input class="form-control col-8" type="text" name="firewood">
								</div>
								<div class="row align-items-center">
									<label class="col-4 pt-2">c) Charcoal</label><input class="form-control col-8" type="text" name="charcoal">
								</div>
								<div class="row align-items-center">
									<label class="col-4 pt-2">d) Palm kernel</label><input class="form-control col-8" type="text" name="palm_kernel">
								</div>
								<div class="row align-items-center">
									<label class="col-4 pt-2">e) Others</label><input class="form-control col-8" type="text" name="others">
								</div>
							</div>
						</div>
						<div class="form-group basic">
							<div class="input-wrapper">
								<label class="label" for="no_of_studs_who_take_meals_day">Number of students who take meals in your school per day</label>
								<input type="number" class="form-control" name="no_of_studs_who_take_meals_day" id="no_of_studs_who_take_meals_day">
							</div>
						</div>
						<div class="form-group basic">
							<div class="input-wrapper">
								<label class="label" for="no_of_stoves">Number of Stoves: (maximum per school is 5 stoves or 550 students per stove)</label>
								<input type="number" class="form-control" name="no_of_stoves" id="no_of_stoves" max="5">
							</div>
						</div>
						<div class="form-group basic">
							<div class="input-wrapper">
								<label class="label" for="accept_maintenance_fee">We accept to pay a yearly maintenance fee of GHC1200</label>
								<select name="accept_maintenance_fee" id="accept_maintenance_fee" class="form-control">
									<option value="default">Select Option</option>
									<option value="yes">Yes</option>
									<option value="no">No</option>
								</select>
							</div>
						</div>
						<div class="form-group basic">
							<div class="input-wrapper">
								<label class="label" for="accept_firewood_purchase">Are you willing to allow for the verification of firewood purchases?</label>
								<select name="accept_firewood_purchase" id="accept_firewood_purchase" class="form-control">
									<option value="default">Select Option</option>
									<option value="yes">Yes</option>
									<option value="no">No</option>
								</select>
							</div>
						</div>
						<div class="form-group basic">
							<div class="input-wrapper">
								<label class="label" for="allow_information_usage">Are you willing to allow us to use information, photos and videos gathered from the project?</label>
								<select name="allow_information_usage" id="allow_information_usage" class="form-control">
									<option value="default">Select Option</option>
									<option value="yes">Yes</option>
									<option value="no">No</option>
								</select>
							</div>
						</div>
						<div class="form-group basic">
							<div class="input-wrapper">
								<label class="label" for="permit_shooting_of_photos">Would you permit the shooting of photos and videos to market the project?</label>
								<select name="permit_shooting_of_photos" id="permit_shooting_of_photos" class="form-control">
									<option value="default">Select Option</option>
									<option value="yes">Yes</option>
									<option value="no">No</option>
								</select>
							</div>
						</div>
						<div class="form-group basic">
							<div class="input-wrapper">
								<label class="label" for="provide_support">Will you provide support and cooperate with project external auditors during project verification?</label>
								<select name="provide_support" id="provide_support" class="form-control">
									<option value="default">Select Option</option>
									<option value="yes">Yes</option>
									<option value="no">No</option>
								</select>
							</div>
						</div>
						<div class="form-group basic">
							<div class="input-wrapper">
								<label class="label" for="agreement_of_stove_use">Are you willing to enter into proper agreement for the free use of the stove?</label>
								<select name="agreement_of_stove_use" id="agreement_of_stove_use" class="form-control">
									<option value="default">Select Option</option>
									<option value="yes">Yes</option>
									<option value="no">No</option>
								</select>
							</div>
						</div>
						<div class="form-group basic">
							<div class="input-wrapper">
								<label class="label" for="carbon_waiver">Are you willing to sign carbon waiver on the stoves? Ee template.</label>
								<select name="carbon_waiver" id="carbon_waiver" class="form-control">
									<option value="default">Select Option</option>
									<option value="yes">Yes</option>
									<option value="no">No</option>
								</select>
							</div>
						</div>
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