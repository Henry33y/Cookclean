 <?php
// Include the database configuration file
include('includes/db_config.php');	
$statusMsg = '';

$gps = $_POST['gps'];
$town = $_POST['town'];
$region = $_POST['region'];
$town_location = $_POST['gps'];

$agent_id = $_POST['agent_id'];


if(isset($_POST["submit"]) && !empty($_POST["town"])){
    $insert = $conn->query("INSERT INTO `towns` (`town_name`, `town_region`, `town_location`) VALUES ('".$town."', '".$region."', '".$town_location."')");
	if($insert){
		$statusMsg = "Town saved successfully.";
	}else{
		$statusMsg = "Failed, please try again.";
	} 
}else{
    $statusMsg = 'Enter a town name to save.';
}

// Display status message
echo $statusMsg;
          
header("Location: town.php?statusMsg=".$statusMsg);
exit();
?>