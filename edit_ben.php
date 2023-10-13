 <?php
// Include the database configuration file
include('includes/db_config.php');	
$statusMsg = '';

$ben_id = $_POST['ben_id'];
$gps = $_POST['gps'];
$town_id = $_POST['town_id'];
$community = $_POST['community'];

$name = $_POST['name'];
$gender = $_POST['gender'];
$age = $_POST['age'];
$contact = $_POST['contact'];
$alt_contact = $_POST['alt_contact'];
$cookstove = $_POST['model'];
$installment = $_POST['installment'];

$agent_id = $_POST['agent_id'];

// File upload path
$targetDir = "uploads/";
$fileName = $name.'-'.basename($_FILES["idcard"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["idcard"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf','PNG','JPG','JPEG');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["idcard"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            	
			$insert = $conn->query("UPDATE `beneficiaries` SET `fullname` = '".$name."', `gender` = '".$gender."', `age` = '".$age."', `contact` = '".$contact."', `alt_contact` = '".$alt_contact."', `gps` = '".$gps."', `photo` = '".$fileName."', `community` = '".$community."', `cookstove` = '".$cookstove."', `installment` = '".$installment."' WHERE `beneficiaries`.`id` = ".$ben_id."");
					
			
            if($insert){
                $statusMsg = "Update successful.";
            }else{
                $statusMsg = "Update failed! Please try again.";
            }  
			
			
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{	
	$insert = $conn->query("UPDATE `beneficiaries` SET `fullname` = '".$name."', `gender` = '".$gender."', `age` = '".$age."', `contact` = '".$contact."', `alt_contact` = '".$alt_contact."', `gps` = '".$gps."', `community` = '".$community."', `cookstove` = '".$cookstove."' WHERE `beneficiaries`.`id` = ".$ben_id."");
			
	if($insert){
		$statusMsg = "Update successful.";
	}else{
		$statusMsg = "Update failed! Please try again.";
	} 	
}

// Display status message
echo $statusMsg;
          
header("Location: all.php?statusMsg=".$statusMsg);
exit();
?>